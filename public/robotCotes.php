<?php
declare (strict_types = 1);
namespace AppApiRest;
header('Content-Type: text/html; charset=UTF-8');

use \DateTime;
use \Connexion\ConfigDataBase;
use \Connexion\Database;
use \Team\TeamManagerMYSQL;
use \Match\MatchManagerMYSQL;
use \Cotes\Cotes;
use \Cotes\CotesManagerMYSQL;

require_once './../app/Autoloader.class.php';
Autoloader::register();
$ConfigDataBase = new ConfigDataBase('lefevrecuv001', './../');
$Db = Database::init($ConfigDataBase);

$Robot = new Robot('https://www.betclic.fr/football/coupe-du-monde-e1');
$data = $Robot->decryptageData();


class Robot {
    /**
     * url sur la quel on va piquer les donnÃ©es
     *
     * @var string $url
     */
    private $url;
    /**
     * code html de la page
     *
     * @var string $codePage
     */
    private $codePage;
    /**
     * Liste des teams
     *
     * @var array $listTeam
     */
    private $listTeam;
    /**
     * Liste des matchss
     *
     * @var array $listMatch
     */
    private $listMatch;

    /**
     * Construct de la fonction
     *
     * @param string $url
     */
    public function __construct(string $url) {
        $this->setUrl($url);
        $this->loadCodePage();
        $this->loadListTeam();
        $this->loadListMatch();
    }

    /**
     * Chargemen du code html de la page
     *
     * @return void
     */
    public function loadCodePage() {
        $this->codePage = file_get_contents($this->getUrl());
    }

    /**
     * Recuperation des cotes depuis le code html de la page
     *
     * @return void
     */
    public function decryptageData() {
        $listJours = $this->decoupageParJour();
        $dateNow = new DateTime();

        if(is_array($listJours) === true && empty($listJours) === false) {
            foreach($listJours as $day) {
                //Recuperation date match
                $dateMatch = $this->getAttr($day, 'data-date="', '"');
                $t = explode('-', $dateMatch);
                $dateMatch = new DateTime();
                $dateMatch->setDate((int)$t[0], (int)$t[1], (int)$t[2]);
                $dateMatch->setTime(0, 0, 0);
                unset($t);
                
                $listHeure = explode('<div class="schedule clearfix">', $day);
                foreach($listHeure as $horaire) {
                    
                    $heures = $this->getAttr($horaire, '<div class="hour">', '<');
                    if(strlen($heures) === 5) {
                        $heures = explode(':', $heures);
                        $dateMatch->setTime((int)$heures[0], (int)$heures[1], 0);

                        $idTeamA = 0;
                        $idTeamB = 0;

                        $listMatchHtml = explode('data-track-event-name="', $horaire);
                        unset($listMatchHtml[0]);

                        foreach($listMatchHtml as $htmlMatch) {
                            $pos = stripos($htmlMatch, '">', 0);
                            $listTeam = substr($htmlMatch, 0, $pos);
                            $listTeam = explode(' - ', $listTeam);
                            $nomTemp = $this->decodeNomTeam($listTeam[0]);
                            
                            $idTeamA = (int)$this->listTeam[$nomTemp];
                            $nomTemp = $this->decodeNomTeam($listTeam[1]);
                            $idTeamB = (int)$this->listTeam[$nomTemp];
                            
                            $dataMatch = explode('<div class="match-odd">', $htmlMatch);
                            if(is_array($dataMatch) === true && empty($dataMatch) === false) {
                                unset($dataMatch[0]);
                                $i = 0;
                                foreach($dataMatch as $data) {
                                    $cote[$i] = $this->getAttr($data, '>', '<');
                                    $cote[$i] = (float)str_replace(',', '.', $cote[$i]);
                                    $i++;
                                }
                                unset($i);
                            }
                            
                            if(is_array($this->listMatch) === true && empty($this->listMatch) === false) {
                                foreach($this->listMatch as $Match) {
                                    if($Match->isThisMatch($dateMatch, $idTeamA, $idTeamB) === true) {
                                        $idTypePari = 1;
                                        $Cotes = new Cotes(array(
                                            'id'         => -1,
                                            'idMatch'    => $Match->getId(),
                                            'idTypePari' => $idTypePari,
                                            'idTeam'     => $idTeamA,
                                            'cote'       => $cote[0],
                                            'date'       => $dateNow,
                                        ));
                                        CotesManagerMYSQL::insertCotes($Cotes);
                                        $Cotes = new Cotes(array(
                                            'id'         => -1,
                                            'idMatch'    => $Match->getId(),
                                            'idTypePari' => $idTypePari,
                                            'idTeam'     => 0,
                                            'cote'       => $cote[1],
                                            'date'       => $dateNow,
                                        ));
                                        CotesManagerMYSQL::insertCotes($Cotes);
                                        $Cotes = new Cotes(array(
                                            'id'         => -1,
                                            'idMatch'    => $Match->getId(),
                                            'idTypePari' => $idTypePari,
                                            'idTeam'     => $idTeamB,
                                            'cote'       => $cote[2],
                                            'date'       => $dateNow,
                                        ));
                                        CotesManagerMYSQL::insertCotes($Cotes);
                                        
                                        break;
                                    }
                                }
                                unset($Match, $Cotes);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Decode le nom de la team
     *
     * @param string $team
     * @return string $team
     */
    public function decodeNomTeam(string $team) {
        if(stripos($team, 'gypte') !== false) {
            $team = 'egypte';
        }
        if(stripos($team, 'e du sud') !== false) {
            $team = 'coree du sud';
        }
        if(stripos($team, 'ria') !== false) {
            $team = 'nigeria';
        }
        if(stripos($team, 'su') !== false && stripos($team, 'de') !== false) {
            $team = 'suede';
        }
        $team = str_replace(array('Ã©','Ã©','Ã¨'), array('&#233;','&#201;','&#232'), $team);
     
        $team = \strtolower(htmlentities($team));
        
        return $team;
    }

    /**
     * Recuperation de la valeur
     *
     * @param string $day
     * @param string $start
     * @param string $end
     * @return void
     */
    public function getAttr(string $day, string $start, string $end) {
        $len = strlen($start);
        $pos = stripos($day, $start);
        $day = substr($day, $pos+$len);
        $pos = stripos($day, $end);
        return substr($day, 0, $pos);
    }

    /**
     * Decoupe le code html en tableau qui represente les jours de la compete
     *
     * @return array $listJour
     */
    public function decoupageParJour() {
        $listJour = explode('entry day-entry grid-9 nm', $this->codePage);
        unset($listJour[0]);
        
        return $listJour;
    }
    
    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of codePage
     */ 
    public function getCodePage()
    {
        return $this->codePage;
    }

    /**
     * Get the value of listTeam
     */ 
    public function getListTeam()
    {
        return $this->listTeam;
    }

    /**
     * Set the value of listTeam
     *
     * @return  self
     */ 
    public function loadListTeam()
    {
        $listTeam = TeamManagerMYSQL::loadListAllTeam();
        if(is_array($listTeam) === true && empty($listTeam) === false) {
            foreach($listTeam as $team) {
                $Team = new \Team\Team($team);
                $nom = $this->decodeNomTeam($Team->getNom());
                $this->listTeam[$nom] = $Team->getId();
            }
            unset($team, $Team, $nom);
        } 
        return $this;
    }

    /**
     * Get the value of listMatch
     */ 
    public function getListMatch()
    {
        return $this->listMatch;
    }

    /**
     * Set the value of listMatch
     *
     * @return  self
     */ 
    public function loadListMatch()
    {
        $listMatch = MatchManagerMYSQL::loadListAllMatch();
        
        if(is_array($listMatch) === true && empty($listMatch) === false) {
            foreach($listMatch as $match) {
                $Match = new \Match\Match($match);
                $this->listMatch[$Match->getId()] = $Match;
            }
            unset($match, $Match);
        }

        return $this;
    }
}
