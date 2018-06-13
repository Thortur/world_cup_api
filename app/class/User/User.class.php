<?php
declare(strict_types = 1);
namespace User;
use \DateTime;
use \Cagnotte\CagnotteManagerMYSQL;
use \Cagnotte\Cagnotte;

class User {
    /**
     * id User
     *
     * @var int
     */
    private $id;
    /**
     * nom user
     *
     * @var string
     */
    private $nom;
    /**
     * prenom user
     *
     * @var string
     */
    private $prenom;
    /**
     * pseudo user
     *
     * @var string
     */
    private $pseudo;
    /**
     * avatar user
     *
     * @var int
     */
    private $avatar;
    /**
     * mail user
     *
     * @var string
     */
    private $mail;
    /**
     * password user
     *
     * @var string
     */
    private $password;
    /**
     * mail confirm
     * 
     * @var bool
     */
    private $mailConfirm;

    /**
     * Data user
     *
     * @var DataUser
     */
    private $dataUser;
    
    /**
     * Construct
     * 
     * @param array $data
     */
    public function __construct(array $data)
    {
        if(empty($data['id']) === true) {
            $data['id'] = -1;
        }
        if(empty($data['mailConfirm']) === true) {
            $data['mailConfirm'] = false;
        }
        $this->setId((int)$data['id']);
        $this->setNom((string)$data['nom']);
        $this->setPrenom((string)$data['prenom']);
        $this->setPseudo((string)$data['pseudo']);
        $this->setAvatar((int)$data['avatar']);
        $this->setMail((string)$data['mail']);
        $this->setPassword((string)$data['password']);
        $this->setMailConfirm((bool)$data['mailConfirm']);
        if(empty($data['dataUser']) === true) {
            $data['dataUser'] = new DataUser(array());
        }
        $this->setDataUser($data['dataUser']);
    }

    /**
     * Retourne un tableau representatif de l'object Team
     */
    public function getArray() {
        return array(
            'id'          => $this->getId(),
            'nom'         => $this->getNom(),
            'prenom'      => $this->getPrenom(),
            'pseudo'      => $this->getPseudo(),
            'avatar'      => $this->getAvatar(),
            'mail'        => $this->getMail(),
            'mailConfirm' => $this->isMailConfirm(),
        );
    }

    /**
     * Get id User
     *
     * @return int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id User
     *
     * @param int $id id User
     *
     * @return self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get nom user
     *
     * @return  string
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom user
     *
     * @param string  $nom  nom user
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get prenom user
     *
     * @return string
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set prenom user
     *
     * @param string $prenom  prenom user
     *
     * @return  self
     */ 
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get pseudo user
     *
     * @return string
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set pseudo user
     *
     * @param string  $pseudo  pseudo user
     *
     * @return self
     */ 
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get 1 = femme
     *
     * @return  bool
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set avatar
     *
     * @param  bool  $avatar
     *
     * @return  self
     */ 
    public function setAvatar(int $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get mail user
     *
     * @return string
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set mail user
     *
     * @param string  $mail  mail user
     *
     * @return self
     */ 
    public function setMail(string $mail)
    {
        $this->mail = strtolower($mail);

        return $this;
    }

    /**
     * Get password user
     *
     * @return string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password user
     *
     * @param string  $password  password user
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }    

    /**
     * Get mail confirm
     *
     * @return  bool
     */ 
    public function isMailConfirm()
    {
        return $this->mailConfirm;
    }

    /**
     * Set mail confirm
     *
     * @param  bool  $mailConfirm  mail confirm
     *
     * @return  self
     */ 
    public function setMailConfirm(bool $mailConfirm)
    {
        $this->mailConfirm = $mailConfirm;

        return $this;
    }

    /**
     * Get data user
     *
     * @return  array
     */ 
    public function getDataUser()
    {
        return $this->dataUser;
    }

    /**
     * Set data user
     *
     * @param  DataUser  $dataUser  Data user
     *
     * @return  self
     */ 
    public function setDataUser(DataUser $dataUser)
    {
        $this->dataUser = $dataUser;

        return $this;
    }


    /**
     * Creation de l'utilisateur
     * 
     * @param User $User
     * @return User $User
     */
    public static function createUser(User $User) {
        if(UserManagerMYSQL::isLoginOrMailExiste($User) === false) {
            $User = UserManagerMYSQL::insertUser($User);
            $SendMail = new \SendMail\SendMail(array(
                'mailAuto' => true,
                'destinataire' => array(
                    'mail' => $User->getMail(),
                    'nom'  => $User->getPseudo(),
                ),
                'subject' => "Confirmation d'adresse mail",
                'body'    => "Bonjour,<br/>\n<br/>\n
                Vous venez de vous inscrire Mais votre compte n'est pas encore actif.<br/>\n
                Pour l'activer et passé un bon petit moment, clique sur le lien suivant pour confimer ton adresse mail : <a href=\"https://www.worldcup.lefevrechristophe.fr/public/confirmMail.php?id=".$User->getId()."&mail=".$User->getMail()."\">Je confirme mon adresse mail!</a><br/>\n<br/>\nSinon tu fais rien...<br/>\n<br/>\nBonne journée, ou fin de journée, ou bonne nuit... c'est comme tu veux.<br/>\n<br/>\n Support.",
                'altBody' => '',
            ));
            $SendMail->send();

            $Cagnotte = new Cagnotte(array(
                'id'      => -1,
                'idUser'  => $User->getId(),
                'date'    => new DateTime(),
                'montant' => 500,
            ));
            $Cagnotte = CagnotteManagerMYSQL::insertCagnotte($Cagnotte);
            $DataUser = new DataUser(array(
                'cagnotte' => array($Cagnotte),
            ));

            $User->setDataUser($DataUser);
        }
        else {
            $User = false;
        }

        return $User;
    }
}