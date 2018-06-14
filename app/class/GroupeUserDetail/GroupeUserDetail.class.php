<?php
declare(strict_types = 1);
namespace GroupeUserDetail;

class GroupeUserDetail {
    /**
     * id type groupe match detail
     *
     * @var int
     */
    private $id;
    /**
     * id groupe user
     *
     * @var int
     */
    private $idGroupeUser;
    /**
     * ordre de la team dans le groupe
     *
     * @var int
     */
    private $idUser;

    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct(array $data) {
        $this->setId((int)$data['id']);
        $this->setIdGroupeUser((int)$data['idGroupeUser']);
        $this->setIdUser((int)$data['idUser']);
    }
    
    /**
     * Retourne un tableau representatif de l'object
     */
    public function getArray() {
        return array(
            'id'           => $this->getId(),
            'idGroupeUser' => $this->getIdGroupeUser(),
            'idUser'       => $this->getIdUser(),
        );
    }

    /**
     * Get id type pari
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id type pari
     *
     * @param  int  $id  id type pari
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id groupe
     *
     * @return  int
     */ 
    public function getIdGroupeUser()
    {
        return $this->idGroupeUser;
    }

    /**
     * Set id groupe
     *
     * @param  int  $idGroupeUser  id groupe
     *
     * @return  self
     */ 
    public function setIdGroupeUser(int $idGroupeUser)
    {
        $this->idGroupeUser = $idGroupeUser;

        return $this;
    }

    /**
     * Get ordre de la team dans le groupe
     *
     * @return  int
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set ordre de la team dans le groupe
     *
     * @param  int  $idUser  ordre de la team dans le groupe
     *
     * @return  self
     */ 
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}