<?php
declare(strict_types = 1);
namespace Team;

class Team {
    /**
     * id team
     *
     * @var int
     */
    private $id;
    /**
     * nom de la team
     *
     * @var string
     */
    private $nom;
    /**
     * si pour les flag
     *
     * @var string
     */
    private $iso;
    /**
     * si pour les flag (2 caractere)
     *
     * @var string
     */
    private $iso2;
    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct(array $data) {
        $this->setId((int)$data['id']);
        $this->setNom((string)$data['nom']);
        $this->setIso((string)$data['iso']);
        $this->setIso2((string)$data['iso2']);
    }

    /**
     * Retourne un tableau representatif de l'object Team
     */
    public function getArray() {
        return array(
            'id'   => $this->getId(),
            'nom'  => $this->getNom(),
            'iso'  => $this->getIso(),
            'iso2' => $this->getIso2(),
        );
    }

    /**
     * @param int $id de la team
     */
    public function setId(int $id) {
        $this->id = (int)$id;
    }

    /**
     * @return int id de la team
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $nom de la team
     */
    public function setNom(string $nom) {
        $this->nom = (string)$nom;
    }

    /**
     * @return string nom de la team
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * @param string $nom de la team
     */
    public function setIso(string $iso) {
        $this->iso = (string)$iso;
    }

    /**
     * @return string nom de la team
     */
    public function getIso() {
        return $this->iso;
    }

    /**
     * Retourne la flag de la team
     * 
     * @return string $flag
     */
    public function getflag() {
        return $flag;
    }

    /**
     * Get si pour les flag (2 caractere)
     *
     * @return  string
     */ 
    public function getIso2()
    {
        return $this->iso2;
    }

    /**
     * Set si pour les flag (2 caractere)
     *
     * @param  string  $iso2  si pour les flag (2 caractere)
     *
     * @return  self
     */ 
    public function setIso2(string $iso2)
    {
        if(empty($iso2) === true) {
            $iso2 = '_NATO';
        }

        $this->iso2 = $iso2;

        return $this;
    }
}