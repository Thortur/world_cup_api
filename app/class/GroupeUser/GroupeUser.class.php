<?php
declare(strict_types = 1);
namespace GroupeUser;

class GroupeUser {
    /**
     * id groupe user
     *
     * @var int
     */
    private $id;
    /**
     * code du groupe
     *
     * @var string
     */
    private $code;
    /**
     * nom du groupe
     *
     * @var string
     */
    private $nom;
    /**
     * id user createur
     *
     * @var int
     */
    private $idUserMaster;
    /**
     * groupe
     *
     * @var bool
     */
    private $private;

    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct(array $data) {
        $this->setId((int)$data['id']);
        $this->setCode((string)$data['code']);
        $this->setNom((string)$data['nom']);
        $this->setIdUserMaster((int)$data['idUserMaster']);
        $this->setPrivate((bool)$data['private']);
    }
    
    /**
     * Retourne un tableau representatif de l'object
     */
    public function getArray() {
        return array(
            'id'           => $this->getId(),
            'code'         => $this->getCode(),
            'nom'          => $this->getNom(),
            'idUserMaster' => $this->getIdUserMaster(),
            'private'      => $this->isPrivate(),
        );
    }

    /**
     * Get id groupe match
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id groupe match
     *
     * @param  int  $id  id groupe match
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Get code du groupe
     *
     * @return  string
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code du groupe
     *
     * @param  string  $code  code du groupe
     *
     * @return  self
     */ 
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get nom du groupe
     *
     * @return  string
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom du groupe
     *
     * @param  string  $nom  nom du groupe
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get id user createur
     *
     * @return  int
     */ 
    public function getIdUserMaster()
    {
        return $this->idUserMaster;
    }

    /**
     * Set id user createur
     *
     * @param  int  $idUserMaster  id user createur
     *
     * @return  self
     */ 
    public function setIdUserMaster(int $idUserMaster)
    {
        $this->idUserMaster = $idUserMaster;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return  bool
     */ 
    public function isPrivate()
    {
        return $this->private;
    }

    /**
     * Set groupe
     *
     * @param  bool  $private  groupe
     *
     * @return  self
     */ 
    public function setPrivate(bool $private)
    {
        $this->private = $private;

        return $this;
    }
}