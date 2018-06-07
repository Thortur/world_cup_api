<?php
declare(strict_types = 1);
namespace AppApiRest;

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
}