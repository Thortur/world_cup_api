<?php
declare(strict_types = 1);
namespace Cagnotte;
use \DateTime;

class Cagnotte {
    /**
     * id Cagnotte
     *
     * @var int
     */
    private $id;
    /**
     * idUser
     *
     * @var int
     */
    private $idUser;
    /**
     * idUser
     *
     * @var int
     */
    private $idPari;
    /**
     * Date de la cagnotte
     *
     * @var DateTime
     */
    private $date;
    /**
     * montant de la cagnotte
     *
     * @var float 
     */
    private $montant;


    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct(array $data) {
        $this->setId((int)$data['id']);
        $this->setIdUser((int)$data['idUser']);
        $this->setIdPari((int)$data['idPari']);
        $this->setDate($data['date']);
        $this->setMontant((float)$data['montant']);
    }

    /**
     * Retourne un tableau representatif de l'object
     */
    public function getArray() {
        return array(
            'id'         => $this->getId(),
            'idUser'     => $this->getIdUser(),
            'idPari'     => $this->getIdPari(),
            'montant'    => $this->getMontant(),
            'date'       => $this->getDate()->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Get id Cagnotte
     *
     * @return int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id Cagnotte
     *
     * @param int $id id Cagnotte
     *
     * @return self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idUser
     *
     * @param int $idUser
     *
     * @return self
     */ 
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return  int
     */ 
    public function getIdPari()
    {
        return $this->idPari;
    }

    /**
     * Set idUser
     *
     * @param  int  $idPari  idUser
     *
     * @return  self
     */ 
    public function setIdPari(int $idPari)
    {
        $this->idPari = $idPari;

        return $this;
    }

    /**
     * Get date de la cagnotte
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
            if($dateUpdate === null) {
                $dateUpdate = '';
            }
            $this->date = new DateTime($date);
        }

        return $this;
    }

    /**
     * Get montant de la cagnotte
     *
     * @return  float
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set montant de la cagnotte
     *
     * @param  float  $montant  montant de la cagnotte
     *
     * @return  self
     */ 
    public function setMontant(float $montant)
    {
        $this->montant = $montant;

        return $this;
    }
}