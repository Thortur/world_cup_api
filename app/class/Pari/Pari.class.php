<?php
declare(strict_types = 1);
namespace Pari;
use \DateTime;

class Pari {
    /**
     * id du pari
     * 
     * @var int
     */
    private $id;
    /**
     * id du match
     * 
     * @var int
     */
    private $idMatch;
    /**
     * id du type de pari
     * 
     * @var int
     */
    private $idTypePari;
    /**
     * id de l'user
     * 
     * @var int
     */
    private $idUser;
    /**
     * id de la cote
     * 
     * @var int
     */
    private $idCotes;
    /**
     * montant du pari
     * 
     * @var float
     */
    private $montant;
    /**
     * gain du pari
     * 
     * @var float
     */
    private $gain;
    /**
     * date du pari
     * 
     * @var DateTime
     */
    private $date;

    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct($data) {
        $this->setId((int)$data['id']);
        $this->setIdMatch((int)$data['idMatch']);
        $this->setIdTypePari((int)$data['idTypePari']);
        $this->setIdUser((int)$data['idUser']);
        $this->setIdCotes((int)$data['idCotes']);
        $this->setMontant((float)$data['montant']);
        $this->setGain((float)$data['gain']);
        $this->setDate($data['date']);
    }

    /**
     * Retourne un tableau representatif de l'object
     */
    public function getArray() {
        return array(
            'id'         => $this->getId(),
            'idMatch'    => $this->getIdMatch(),
            'idTypePari' => $this->getIdTypePari(),
            'idUser'     => $this->getIdUser(),
            'idCotes'    => $this->getIdCotes(),
            'montant'    => $this->getMontant(),
            'gain'       => $this->getGain(),
            'date'       => $this->getDate()->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Get id du pari
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id du pari
     *
     * @param  int  $id  id du pari
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id du match
     *
     * @return  int
     */ 
    public function getIdMatch()
    {
        return $this->idMatch;
    }

    /**
     * Set id du match
     *
     * @param  int  $idMatch  id du match
     *
     * @return  self
     */ 
    public function setIdMatch(int $idMatch)
    {
        $this->idMatch = $idMatch;

        return $this;
    }

    /**
     * Get id du type de pari
     *
     * @return  int
     */ 
    public function getIdTypePari()
    {
        return $this->idTypePari;
    }

    /**
     * Set id du type de pari
     *
     * @param  int  $idTypePari  id du type de pari
     *
     * @return  self
     */ 
    public function setIdTypePari(int $idTypePari)
    {
        $this->idTypePari = $idTypePari;

        return $this;
    }

    /**
     * Get id de l'user
     *
     * @return  int
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set id de l'user
     *
     * @param  int  $idUser  id de l'user
     *
     * @return  self
     */ 
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get id de la cote
     *
     * @return  int
     */ 
    public function getIdCotes()
    {
        return $this->idCotes;
    }

    /**
     * Set id de la cote
     *
     * @param  int  $idCotes  id de la cote
     *
     * @return  self
     */ 
    public function setIdCotes(int $idCotes)
    {
        $this->idCotes = $idCotes;

        return $this;
    }

    /**
     * Get montant du pari
     *
     * @return  float
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set montant du pari
     *
     * @param  float  $montant  montant du pari
     *
     * @return  self
     */ 
    public function setMontant(float $montant)
    {
        $this->montant = $montant;

        return $this;
    }
    
    /**
     * Get gain du pari
     *
     * @return  float
     */ 
    public function getGain()
    {
        return $this->gain;
    }

    /**
     * Set gain du pari
     *
     * @param  float  $gain  gain du pari
     *
     * @return  self
     */ 
    public function setGain(float $gain)
    {
        $this->gain = $gain;

        return $this;
    }

    /**
     * Get date du pari
     *
     * @return  DateTime
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date de la cagnotte
     *
     * @param DateTime|string $date  Date de la cagnotte
     *
     * @return self
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
}