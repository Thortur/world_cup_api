<?php
declare (strict_types = 1);
namespace AppApiRest;
header('Content-Type: text/html; charset=UTF-8');

use \DateTime;
use \Connexion\ConfigDataBase;
use \Connexion\Database;
use \Team\TeamManagerMYSQL;

require_once './../app/Autoloader.class.php';
Autoloader::register();
$ConfigDataBase = new ConfigDataBase('lefevrecuv001', './../');
$Db = Database::init($ConfigDataBase);
// $listTeam = 
// echo '<pre>';
// var_dump($listTeam);
// echo '</pre>';

$Robot = new Robot('https://www.betclic.fr/football/coupe-du-monde-e1');
$data = $Robot->decryptageData();


class Robot {
    private $url;
    private $codePage;
    private $listTeam;

    public function __construct($url) {
        $this->setUrl($url);
        $this->loadCodePage();
        $this->setListTeam();
    }

    public function loadCodePage() {
        $this->codePage = file_get_contents($this->getUrl());
    }

    public function decryptageData() {
        $listJours = $this->decoupageParJour();

        if(is_array($listJours) === true && empty($listJours) === false) {
            foreach($listJours as $day) {
                //Recuperation date match
                $dateMatch = $this->getAttr($day, 'data-date="', '"');
                $t = explode('-', $dateMatch);
                $dateMatch = new DateTime();
                $dateMatch->setDate((int)$t[0], (int)$t[1], (int)$t[2]);
                $dateMatch->setTime(0, 0, 0);
                unset($t);
                
                $listMatch = explode('<div class="schedule clearfix">', $day);
                foreach($listMatch as $match) {
                    $heures = $this->getAttr($match, '<div class="hour">', '<');
                    if(strlen($heures) === 5) {
                        $heures = explode(':', $heures);
                        $dateMatch->setTime((int)$heures[0], (int)$heures[1], 0);

                        $idTeamA = 0;
                        $idTeamB = 0;

                        $listTeam = $this->getAttr($day, 'data-track-event-name="', '"');
                        $listTeam = explode(' - ', $listTeam);

                        echo '<pre>';
                        $nomTemp = $this->simplificationNomTeam($listTeam[0]);
                        $idTeamA = $this->listTeam[$nomTemp];
                        // if(is_null($idTeamA)) {
                        //     echo $nomTemp.'<br/>';
                        // }
                        $nomTemp = $this->simplificationNomTeam($listTeam[1]);
                        $idTeamB = $this->listTeam[$nomTemp];
                        // if(is_null($idTeamB)) {
                        //     echo $nomTemp.'<br/>';
                        // }
                        // echo $this->simplificationNomTeam($listTeam[1]); 
                        // echo $match;
                        $dataMatch = explode('<div class="match-odd">', $match);
                        if(is_array($dataMatch) === true && empty($dataMatch) === false) {
                            unset($dataMatch[0]);
                            $i = 0;
                            foreach($dataMatch as $data) {
                                $cote[$i] = $listTeam = $this->getAttr($data, '>', '<');
                                $i++;
                            }
                            unset($i);
                        }

                        
                        var_dump($cote);
                        // var_dump($idTeamA);
                        // var_dump($idTeamB);
                        echo '</pre>';
                    }
                }
            }
        }
    }

    public function simplificationNomTeam($team) {
        // $team = htmlentities($team);
        // $team = \str_replace('&#201;', 'e', $team);
        // $team = \htmlentities(\mb_strtoupper($team), ENT_QUOTES, "UTF-8");
        return \strtolower(\htmlentities($team));
    }

    public function getAttr($day, $start, $end) {
        $len = strlen($start);
        $pos = stripos($day, $start);
        $day = substr($day, $pos+$len);
        $pos = stripos($day, $end);
        return substr($day, 0, $pos);
    }

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
    public function setListTeam()
    {
        $listTeam = TeamManagerMYSQL::loadListAllTeam();
        if(is_array($listTeam) === true && empty($listTeam) === false) {
            foreach($listTeam as $team) {
                $Team = new \Team\Team($team);
                $nom = $this->simplificationNomTeam($Team->getNom());
                $this->listTeam[$nom] = $Team->getId();
            }
        } 
// echo '<pre>';var_dump( $this->listTeam);echo '</pre>';
        return $this;
    }
}
