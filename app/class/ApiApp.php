<?php
declare(strict_types = 1);
namespace AppApiRest;
use \DateTime;
/**
 * Class qui gere les demande du client
 */
class ApiApp extends ApiRest {

    private $langue = 'en_US';
    private $listLangue = array('fr_FR', 'en_US');
    public function __construct() {
        parent::__construct();
    }


    /** 
    * Methode public pour l'acces a l'api. 
    */ 
    public function processApi(){
        if(empty($this->request['request']) === false) {
            $listVar = explode('/', $this->request['request']);
            // if(in_array($listVar[0], $this->listLangue) === true) {
            //     $this->langue = $listVar[0];
            // }
            $func = trim($listVar[0]);
            if((int)method_exists($this, $func) > 0) {
                $this->$func(); 
            }
            else {
                $this->response('', 404); // si la fonction n’existe pas, la réponse sera "Page not found". 
            }
        }
        else {
            $this->response('', 404); // si la fonction n’existe pas, la réponse sera "Page not found". 
        }
    }

    /** 
     * Encode les datas en JSON
     * @param array $data
    */ 
    private function json($data){ 
        if(\is_array($data) === true ||\is_bool($data) === true){ 
            return json_encode($data);
        } 
    }

    /**
     * Connexion de l'user
     * 
     * @return string json de user
     */
    private function loginUser() {
        $User = new \User\User(array(
            'id'       => -1,
            'nom'      => '',
            'prenom'   => '',
            'pseudo'   => (string)$this->requestData['pseudo'],
            'avatar'   => -1,
            'mail'     => '',
            'password' => (string)$this->requestData['password'],
            'dataUser' => array(),
        ));
        
        $User = \User\UserManagerMYSQL::connexion((string)$this->requestData['pseudo'], (string)$this->requestData['password']);
        
        if($User !== false) {
            $this->response($this->json($User->getArray()), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * creation d'un user
     * 
     * @return string json de user
     */
    private function createUser() {
        $User = new \User\User(array(
            'id'       => -1,
            'nom'      => (string)$this->requestData['nom'],
            'prenom'   => (string)$this->requestData['prenom'],
            'pseudo'   => (string)$this->requestData['pseudo'],
            'avatar'   => (int)$this->requestData['avatar'],
            'mail'     => (string)$this->requestData['mail'],
            'password' => (string)$this->requestData['password'],
            'dataUser' => array(),
        ));

        $User = \User\User::createUser($User);
        
        if($User !== false && $User->getId() > -1) {
            $this->response($this->json($User->getArray()), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Reset du mot de passe utilisateur
     */
    private function resetPassWord() {
        if(empty($this->requestData['mail']) === false) {
            $User = new \User\User(array(
                'id'       => -1,
                'nom'      => '',
                'prenom'   => '',
                'pseudo'   => '',
                'avatar'   => -1,
                'mail'     => (string)$this->requestData['mail'],
                'password' => '',
                'dataUser' => array()
            ));
            $User = \User\UserManagerMYSQL::resetPassWord($User);
            $this->response($this->json(true), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Confirmation du mail lors de l'inscription ou modification
     */
    private function confirmMail() {
        if(empty($this->requestData['id']) === false && empty($this->requestData['mail']) === false) {
            \User\UserManagerMYSQL::confirmMail((int)$this->requestData['id'], (string)$this->requestData['mail']);
            $this->response($this->json(true), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Chargement des la liste complete des type de match
     */
    private function loadListAllTypeMatch() {
        $listTypeMatch = \TypeMatch\TypeMatchManagerMYSQL::loadListAllTypeMatch();
        if(empty($listTypeMatch) === false) {
            $this->response($this->json($listTypeMatch), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Chargement des la liste complete des groupes de match
     */
    private function loadListAllGroupe() {
        $listGroupeMatch = \GroupeMatch\GroupeMatchManagerMYSQL::loadListAllGroupe();
        if(empty($listGroupeMatch) === false) {
            $this->response($this->json($listGroupeMatch), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Chargement des la liste complete des groupes de match
     */
    private function loadListAllMatch() {
        $listMatch = \Match\MatchManagerMYSQL::loadListAllMatch();
        if(empty($listMatch) === false) {
            $this->response($this->json($listMatch), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Chargement des la liste complete des groupes de match detail
     */
    private function loadListAllGroupeDetail() {
        $listGroupeMatchDetail = \GroupeMatchDetail\GroupeMatchDetailManagerMYSQL::loadListAllGroupeDetail();
        if(empty($listGroupeMatchDetail) === false) {
            $this->response($this->json($listGroupeMatchDetail), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Chargement des la liste complete des type de pari
     */
    private function loadListAllTypePari() {
        $listTypePari = \TypePari\TypePariManagerMYSQL::loadListAllTypePari();
        if(empty($listTypePari) === false) {
            $this->response($this->json($listTypePari), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Retourne la liste complete des equipes
     */
    private function loadListAllTeam() {
        $listTeam = \Team\TeamManagerMYSQL::loadListAllTeam();
        if(empty($listTeam) === false) {
            $this->response($this->json($listTeam), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Retourne la list complete des groupes user
     */
    private function loadListAllGroupeUser() {
        $listGroupeUser = \GroupeUser\GroupeUserManagerMYSQL::loadListAllGroupeUser();
        if(empty($listGroupeUser) === false) {
            $this->response($this->json($listGroupeUser), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Retourne la list des user par groupe
     */
    private function loadListAllGroupeUserDetail() {
        $listGroupeUserDetail = \GroupeUser\GroupeUserDetailManagerMYSQL::loadListAllGroupeUserDetail();
        if(empty($listGroupeUserDetail) === false) {
            $this->response($this->json($listGroupeUserDetail), 200);
        }
        else {
            $this->response('', 204); 
        }
    }
  
    /**
     * Retourne les data primiere pour la page de Groupe
     */
    private function loadDataPageGroupe() {
        $tabReturn = array(
            'listTeam'              => \Team\TeamManagerMYSQL::loadListAllTeam(),
            'listGroupeMatch'       => \GroupeMatch\GroupeMatchManagerMYSQL::loadListAllGroupe(),
            'listGroupeMatchDetail' => \GroupeMatchDetail\GroupeMatchDetailManagerMYSQL::loadListAllGroupeDetail(),
            'listMatch'             => \Match\MatchManagerMYSQL::loadListAllMatch(),
            'listResultat'          => \Resultat\ResultatManagerMYSQL::loadListAllResultat(),
        );
        
        if(empty($tabReturn) === false) {
            $this->response($this->json($tabReturn), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Retourne les data primiere pour la page dashboard
     */
    private function loadDataPageDashBoard() {
        $dateNow = new DateTime();
        $tabReturn = array(
            'listTeam'              => \Team\TeamManagerMYSQL::loadListAllTeam(),
            'listGroupeMatch'       => \GroupeMatch\GroupeMatchManagerMYSQL::loadListAllGroupe(),
            'listGroupeMatchDetail' => \GroupeMatchDetail\GroupeMatchDetailManagerMYSQL::loadListAllGroupeDetail(),
            'listMatch'             => \Match\MatchManagerMYSQL::loadListAllMatch(),
            'listTypePari'          => \TypePari\TypePariManagerMYSQL::loadListAllTypePari(),
            'listCotes'             => \Cotes\CotesManagerMYSQL::loadLastCotesToDate($dateNow),
            'listPari'              => \Pari\PariManagerMYSQL::loadListAllPari(),
            'listCagnotte'          => \Cagnotte\CagnotteManagerMYSQL::loadAllCagnotte(),
        );
        
        if(empty($tabReturn) === false) {
            $this->response($this->json($tabReturn), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Retourne les data primiere pour la page dashboard
     */
    private function loadListAllPari() {
        $listPari = \Pari\PariManagerMYSQL::loadListAllPari();
        
        if(empty($listPari) === false) {
            $this->response($this->json($listPari), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Retourne les data primiere pour la page dashboard
     */
    private function insertPari() {        
        $Cotes = new \Cotes\Cotes(array(
            'id'            => $this->requestData['idCotes'],
            'idGroupeCotes' => -1,
            'idMatch'       => $this->requestData['idMatch'],
            'idTypePari'    => $this->requestData['idTypePari'],
            'idTeam'        => -1,
            'cote'          => -1,
            'date'          => '',
        ));


        if(\Cotes\CotesManagerMYSQL::isCotesValide($Cotes) === true && empty($this->requestData['montant']) === false) {

            $montant         = (float)$this->requestData['montant'];
            $listCagnotte    = \Cagnotte\CagnotteManagerMYSQL::loadCagnotteUser((int)$this->requestData['idUser']);
            $montantCagnotte = \Cagnotte\CagnotteManager::getCagnottesUser($listCagnotte);
            
            if($montant <= $montantCagnotte) {
                $Pari = new \Pari\Pari(array(
                    'id'         => -1,
                    'idMatch'    => $this->requestData['idMatch'],
                    'idTypePari' => $this->requestData['idTypePari'],
                    'idUser'     => $this->requestData['idUser'],
                    'idCotes'    => $this->requestData['idCotes'],
                    'montant'    => $this->requestData['montant'],
                    'gain'       => 0,
                    'date'       => $this->requestData['date'],
                ));
    
                $idPari = \Pari\PariManagerMYSQL::isDejaPariMatch($Pari);
                $Pari->setId($idPari);
                if($Pari->getId() === -1) {
                    $Pari = \Pari\PariManagerMYSQL::insertPari($Pari);
                    $Cagnotte = new \Cagnotte\Cagnotte(array(
                        'idUser'  => $this->requestData['idUser'],
                        'idPari'  => $Pari->getId(),
                        'date'    => $this->requestData['date'],
                        'montant' => $this->requestData['montant'] * -1,
                    ));
                    \Cagnotte\CagnotteManagerMYSQL::insertCagnotte($Cagnotte);
                }
                else {
                    /*
                    $Pari = \Pari\PariManagerMYSQL::updatePari($Pari); 
                    $Cagnotte = new \Cagnotte\Cagnotte(array(
                        'idUser'  => $this->requestData['idUser'],
                        'idPari'  => $Pari->getId(),
                        'date'    => $this->requestData['date'],
                        'montant' => $this->requestData['montant'] * -1,
                    ));
                    \Cagnotte\CagnotteManagerMYSQL::updateCagnotte($Cagnotte);
                    */
                }
            }
        }
        
        if(empty($listPari) === false) {
            $this->response($this->json($listPari), 200);
        }
        else {
            $this->response('', 204); 
        }
    }

    /**
     * Chargement des cagnotte
     */
    private function loadAllCagnotte() {
        $listCagnotte = \Cagnotte\CagnotteManagerMYSQL::loadAllCagnotte();
        if(empty($listCagnotte) === false) {
            $this->response($this->json($listCagnotte), 200);
        }
        else {
            $this->response('', 204); 
        }
    }
}