<?php
declare(strict_types = 1);
namespace TypeMatch;

class TypeMatch {
    /**
     * id type de match
     *
     * @var int
     */
    private $id;
    /**
     * nom du type de match
     *
     * @var string
     */
    private $nom;

    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct(array $data) {
        $this->setId((int)$data['id']);
        $this->setNom((string)$data['nom']);
    }

    /**
     * Retourne un tableau representatif de l'object TypeMatch
     */
    public function getArray() {
        return array(
            'id'  => $this->getId(),
            'nom' => $this->getNom(),
        );
    }

    /**
     * Get id type de match
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id type de match
     *
     * @param  int  $id  id type de match
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get nom du type de match
     *
     * @return  string
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom du type de match
     *
     * @param  string  $nom  nom du type de match
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }
}