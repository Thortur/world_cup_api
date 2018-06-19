<?php
declare(strict_types = 1);
namespace User;
use \Connexion\Database;
use \DateTime;

include_once 'User.class.php';
include_once 'DataUser.class.php';

class UserManagerMYSQL {
    /**
     * Chargement des infos d'un User
     * 
     * @param int $idUser
     * @param User $USer
     */
    public static function loadUser(int $idUser) {
        
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM user
                WHERE
                    user.id = :idUser
                    AND user.mailConfirm = 1";
        $data = array(
            ':idUser' => array(
                'type'  => 'int',
                'value' => $idUser,
            )
        );
        $res = $Db->execStatement($req, $data);
        if(empty($res) === false) {
            $User = new User($res[0]);
        }
        else {
            $User = new User(array(
                'id'          => -1,
                'nom'         => '',
                'prenom'      => '',
                'pseudo'      => '',
                'avatar'      => '',
                'mail'        => '',
                'mailConfirm' => false
            ));
        }
        
        return $User;
    }

    /**
     * Retourne la list complete des utilisateurs
     *
     * @return array listUser
     */
    public static function loadListAllUser() {
        $listUser = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM user
                WHERE
                    user.mailConfirm = 1";
        $res =  $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $data['id'] = (int)$data['id'];
                $User = new User($data);
                $listUser[$data['id']] = $User->getArray();
            }
            unset($data);
        }
        unset($res);

        return $listUser;
    }

    /**
     * Insert user
     *
     * @param User $User
     * @return User $User
     */
    public static function insertUser(User $User) {
        $Db = Database::init();
        $req = "INSERT INTO user (nom, prenom, pseudo, avatar, mail, password, dateUpdate, newsLetter) VALUES (:nom, :prenom, :pseudo, :avatar, :mail, :password, :dateUpdate, :newsLetter);";
        $data = array(
                    ':nom' => array(
                        'type'  => 'string',
                        'value' => $User->getNom(),
                    ),
                    ':prenom' => array(
                        'type'  => 'string',
                        'value' => $User->getPrenom(),
                    ),
                    ':pseudo' => array(
                        'type'  => 'string',
                        'value' => $User->getPseudo(),
                    ),
                    ':avatar' => array(
                        'type'  => 'int',
                        'value' => $User->getAvatar(),
                    ),
                    ':mail' => array(
                        'type'  => 'string',
                        'value' => $User->getMail(),
                    ),
                    ':password' => array(
                        'type'  => 'string',
                        'value' => self::encodePassWord($User->getPassword()),
                    ),
                    ':dateUpdate' => array(
                        'type'  => 'string',
                        'value' => $User->getDateUpdate()->format('Y-m-d H:i:s'),
                    ),
                    ':newsLetter' => array(
                        'type'  => 'bool',
                        'value' => $User->isNewsLetter(),
                    ),
                );
        $Db->execStatement($req, $data);
        $User->setId($Db->getLastInsertId());
        unset($req, $data);
        
        return $User;
    }

    /**
     * Update user
     *
     * @param User $User
     * @return bool success
     */
    public static function updateUser(User $User) {
        $Db = Database::init();
        $req = "UPDATE user SET nom = :nom, prenom = :prenom, pseudo = :pseudo, avatar = :avatar, mail = :mail, dateUpdate = :dateUpdate, newsLetter = :newsLetter, accordRGPD = :accordRGPD WHERE id = :id;";
        $data = array(
            ':nom' => array(
                'type'  => 'string',
                'value' => $User->getNom(),
            ),
            ':prenom' => array(
                'type'  => 'string',
                'value' => $User->getPrenom(),
            ),
            ':pseudo' => array(
                'type'  => 'string',
                'value' => $User->getPseudo(),
            ),
            ':avatar' => array(
                'type'  => 'int',
                'value' => $User->getAvatar(),
            ),
            ':mail' => array(
                'type'  => 'string',
                'value' => $User->getMail(),
            ),
            ':id' => array(
                'type'  => 'int',
                'value' => $User->getId(),
            ),
            ':dateUpdate' => array(
                'type'  => 'string',
                'value' => $User->getDateUpdate()->format('Y-m-d H:i:s'),
            ),
            ':newsLetter' => array(
                'type'  => 'bool',
                'value' => $User->isNewsLetter(),
            ),
            ':accordRGPD' => array(
                'type'  => 'bool',
                'value' => $User->isAccordRGPD(),
            ),
        );
        $Db->execStatement($req, $data);
        self::updateAccordRGPDHisto($User);
        unset($req, $data, $User);

        return $Db::$_nbLigne;
    }

    /**
     * Update password user
     *
     * @param User $User
     * @return bool success
     */
    public static function updatePassWord(User $User) {
        $Db = Database::init();
        $req = "UPDATE user SET password = :password, dateUpdate = :dateUpdate WHERE id = :id;";
        $data = array(
            ':password' => array(
                'type'  => 'password',
                'value' => self::encodePassWord($User->getPassword()),
            ),
            ':id' => array(
                'type'  => 'int',
                'value' => $User->getId(),
            ),
            ':dateUpdate' => array(
                'type'  => 'string',
                'value' => $User->getDateUpdate()->format('Y-m-d H:i:s'),
            ),
        );
        $Db->execStatement($req, $data);
        unset($req, $data, $User);

        return $Db::$_nbLigne;
    }

    /**
     * Connexion utilisateur
     * 
     * @param string $pseudo
     * @param string $password
     * 
     * @return bool|User $User
     */
    public static function connexion(string $pseudo, string $password) {
        $Db       = Database::init();
        $User     = false;
        $pseudo   = trim($pseudo);
        $password = trim($password);

        if(empty($pseudo) === false && empty($password) === false) {
            $req = "SELECT
                        *
                    FROM user
                    WHERE
                        user.pseudo = :pseudo
                        AND user.password = :password
                        AND mailConfirm = '1'";
            $data = array(
                ':pseudo' => array(
                    'type'  => 'string',
                    'value' => $pseudo,
                ),
                ':password' => array(
                    'type'  => 'string',
                    'value' => self::encodePassWord($password),
                ),
            );

            $res = $Db->execStatement($req, $data);

            if(empty($res) === false) {
                reset($res);
                $firstKey = key($res);
                $data     = $res[$firstKey];
                unset($firstKey);

                $data['id'] = (int)$data['id'];
                $User = new User($data);
            }
            
            unset($req, $data, $res);
        }
        unset($login, $password);
        
        return $User;
    }
    
    /**
     * Test si le login ou le mail est deja utiliser
     * 
     * @param User $User
     * @return bool $error
     */
    public static function isLoginOrMailExiste($User) {
        $Db    = Database::init();
        $error = true;
        $req = "SELECT
                    *
                FROM user
                WHERE
                user.pseudo = :pseudo
                OR user.mail = :mail";
        $data = array(
            ':pseudo' => array(
                'type'  => 'string',
                'value' => $User->getPseudo(),
            ),
            ':mail' => array(
                'type'  => 'string',
                'value' => $User->getMail(),
            ),
        );
        $res = $Db->execStatement($req, $data);
        if(empty($res) === true) {
            $error = false;
        }
        unset($res);

        return $error;
    }

    public static function resetPassWord(User $User) {
        $Db  = Database::init();
        $req = "SELECT
                    *
                FROM user
                WHERE
                    user.mail = :mail";
        $data = array(
            ':mail' => array(
                'type'  => 'string',
                'value' => $User->getMail(),
            ),
        );
        $res = $Db->execStatement($req, $data);
        if(empty($res) === false) {
            $password = substr( str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0,  8);
            $password = self::encodePassWord($password);
            $req = "UPDATE user SET password = '".$password."' WHERE id = '".$res[0]['id']."';";
            $Db->exec($req);
            
            $SendMail = new \SendMail\SendMail(array(
                'mailAuto' => true,
                'destinataire' => array(
                    'mail' => $res[0]['mail'],
                    'nom'  => $res[0]['pseudo'],
                ),
                'subject' => "Chagement de mot de passe",
                'body'    => "Bonjour,<br/>\n<br/>\nVous avez perdu votre mot de passe...<br/>\nBon c'est pour moi, voici ton nouveau mot de passe : ".$password."<br/>\n<br/>\nSupport.",
                'altBody' => '',
            ));
            $SendMail->send();
            unset($password, $req, $SendMail);
        }
        unset($res);
    }

    /**
     * Encodage du mot de passe
     * 
     * @param string password $password
     * @return string $password
     */
    private static function encodePassWord(string $password) {
        // $options = [
        //     'memory_cost' => 1<<17, // 128 Mb
        //     'time_cost'   => 4,
        //     'threads'     => 3,
        // ];
        // return password_hash($password, PASSWORD_ARGON2I, $options);

        return $password;
    }

    /**
     * confimaton de l'adresse mail
     * 
     * @param int $id
     * @param string $mail
     * @return User $User
     */
    public static function confirmMail(int $id, string $mail) {
        $Db      = Database::init();
        $dateNow = new DateTime();

        $req = "UPDATE user SET mailConfirm = 1, dateUpdate = :dateUpdate WHERE id = :id AND mail = :mail;";
        $data = array(
            ':id' => array(
                'type'  => 'int',
                'value' => $id
            ),
            ':mail' => array(
                'type'  => 'string',
                'value' => $mail
            ),
            ':dateUpdate' => array(
                'type'  => 'string',
                'value' => $dateNow->format('Y-m-d H:i:s'),
            ),
        );
        $res = $Db->execStatement($req, $data);
        
        return true;
    }

    /**
     * update accord RGPD
     * 
     * @param User $User
     */
    public static function updateAccordRGPD(User $User) {
        $Db      = Database::init();
        $dateNow = new DateTime();

        $req = "UPDATE user SET mailConfirm = 1, dateUpdate = :dateUpdate WHERE id = :id;";
        $data = array(
            ':id' => array(
                'type'  => 'int',
                'value' => $id
            ),
            ':accordRGPD' => array(
                'type'  => 'int',
                'value' => $User->idaccordRGPD()
            ),
            ':dateUpdate' => array(
                'type'  => 'string',
                'value' => $dateNow->format('Y-m-d H:i:s'),
            ),
        );
        $res = $Db->execStatement($req, $data);

        self::updateAccordRGPDHisto($User);
        
        return true;
    }

    /**
     * update accord RGPD
     * 
     * @param User $User
     */
    public static function updateAccordRGPDHisto(User $User) {
        $Db      = Database::init();
        $dateNow = new DateTime();

        $req = "INSERT INTO userAccordRGPD (idUser, date, accord) VALUES (:idUser, :date, :accordRGPD);";
        $data = array(
            ':idUser' => array(
                'type'  => 'int',
                'value' => $User->getId(),
            ),
            ':date' => array(
                'type'  => 'string',
                'value' => $dateNow->format('Y-m-d H:i:s'),
            ),
            ':accordRGPD' => array(
                'type'  => 'int',
                'value' => $User->idaccordRGPD()
            ),
        );
        $res = $Db->execStatement($req, $data);
        
        return true;
    }
}