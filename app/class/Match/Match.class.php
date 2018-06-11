<?php
declare(strict_types = 1);
namespace Match;
use \DateTime;
class Match {
    /**
     * id match
     *
     * @var int
     */
    private $id;
    /**
     * Date du match
     *
     * @var DateTime
     */
    private $date;
    /**
     * id Team a
     *
     * @var int
     */
    private $teamA;
    /**
     * id Team B
     *
     * @var int
     */
    private $teamB;
    /**
     * id type de match
     *
     * @var int
     */
    private $idTypeMatch;
    /**
     * id du groupe match
     *
     * @var int
     */
    private $idGroupeMatch;

    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct(array $data) {
        $this->setId((int)$data['id']);
        $this->setDate($data['date']);
        $this->setTeamA((int)$data['teamA']);
        $this->setTeamB((int)$data['teamB']);
        $this->setIdTypeMatch((int)$data['idTypeMatch']);
        $this->setIdGroupeMatch((int)$data['idGroupeMatch']);
    }

    /**
     * Checkck si le matche est le meme que l'instance
     *
     * @param DateTime $date
     * @param integer $idTeamA
     * @param integer $idTeamB
     * @return boolean
     */
    public function isThisMatch(DateTime $date, int $idTeamA, int $idTeamB) {
        // if($idTeamA === 32 && $idTeamB === 21 && $date->format('Y-m-d') === $this->getDate()->format('Y-m-d') && $this->getId() === 33) {
        //     echo '<br/>dateMatch => '.$date->format('Y-m-d').' ';
        //     echo '<br/>Match => '.$this->getDate()->format('Y-m-d').'</br>';
        //     print_r($this);

        //     echo '==========================<br>';
            // echo 'if('.$date->format('Y-m-d').' === '.$this->getDate()->format('Y-m-d').' && (('.$idTeamA.' === '.$this->teamA.' && '.$idTeamB.' === '.$this->teamB.') || ('.$idTeamB.' === '.$this->teamA.' && '.$idTeamA.' === '.$this->teamB.'))) {<br/>';
        // }
        if($date->format('Y-m-d') === $this->getDate()->format('Y-m-d') && (($idTeamA === $this->teamA && $idTeamB === $this->teamB) || ($idTeamB === $this->teamA && $idTeamA === $this->teamB))) {

            // if($this->getId() === 33) {
            //     echo '<br/>dateMatch => '.$date->format('Y-m-d').' ';
            //     echo '<br/>Match => '.$this->getDate()->format('Y-m-d').'</br>';
            //     print_r($this);
            // }
            return true;
        }
        return false;
    }

    /**
     * Retourne un tableau representatif de l'object
     */
    public function getArray() {
        return array(
            'id'            => $this->getId(),
            'date'          => $this->getDate()->format('Y-m-d H:i:s'),
            'teamA'         => $this->getTeamA(),
            'teamB'         => $this->getTeamB(),
            'idTypeMatch'   => $this->getIdTypeMatch(),
            'idGroupeMatch' => $this->getIdGroupeMatch(),
        );
    }

    /**
     * Get id match
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id match
     *
     * @param  int  $id  id match
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get date du match
     *
     * @return  DateTime
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date du match
     *
     * @param  DateTime|string  $date  Date du match
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        if($date instanceof DateTime) {
            $this->date = $date;
        }
        else {
            $this->date = new DateTime($date);
        }

        return $this;
    }

    /**
     * Get id Team a
     *
     * @return  int
     */ 
    public function getTeamA()
    {
        return $this->teamA;
    }

    /**
     * Set id Team a
     *
     * @param  int  $teamA  id Team a
     *
     * @return  self
     */ 
    public function setTeamA(int $teamA)
    {
        $this->teamA = $teamA;

        return $this;
    }

    /**
     * Get id Team B
     *
     * @return  int
     */ 
    public function getTeamB()
    {
        return $this->teamB;
    }

    /**
     * Set id Team B
     *
     * @param  int  $teamB  id Team B
     *
     * @return  self
     */ 
    public function setTeamB(int $teamB)
    {
        $this->teamB = $teamB;

        return $this;
    }

    /**
     * Get id type de match
     *
     * @return  int
     */ 
    public function getIdTypeMatch()
    {
        return $this->idTypeMatch;
    }

    /**
     * Set id type de match
     *
     * @param  int  $idTypeMatch  id type de match
     *
     * @return  self
     */ 
    public function setIdTypeMatch(int $idTypeMatch)
    {
        $this->idTypeMatch = $idTypeMatch;

        return $this;
    }

    /**
     * Get id du groupe match
     *
     * @return  int
     */ 
    public function getIdGroupeMatch()
    {
        return $this->idGroupeMatch;
    }

    /**
     * Set id du groupe match
     *
     * @param  int  $idGroupeMatch  id du groupe match
     *
     * @return  self
     */ 
    public function setIdGroupeMatch(int $idGroupeMatch)
    {
        $this->idGroupeMatch = $idGroupeMatch;

        return $this;
    }
}