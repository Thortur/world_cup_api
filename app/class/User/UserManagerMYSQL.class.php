<?php
declare(strict_types = 1);
namespace User;
use \Connexion\Database;
include_once 'User.class.php';
include_once 'DataUser.class.php';

class UserManagerMYSQL {

    /**
     * Retourne la list complete des utilisateurs
     *
     * @return array listUser
     */
    public static function loadListAllTeam() {
        $listUser = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM user";
        $res =  $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $data['id'] = (int)$data['id'];
                $listUser[] = new User($data);
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
        $req = "INSERT INTO user (nom, prenom, pseudo, avatar, mail, password) VALUES (:nom, :prenom, :pseudo, :avatar, :mail, :password);";
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
        $req = "UPDATE user SET nom = :nom, prenom = :prenom, pseudo = :pseudo, avatar = :avatar, mail = :mail WHERE id = :id;";
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
        );
        $Db->execStatement($req, $data);
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
        $req = "UPDATE user SET password = :password WHERE id = :id;";
        $data = array(
            ':password' => array(
                'type'  => 'password',
                'value' => self::encodePassWord($User->getPassword()),
            ),
            ':id' => array(
                'type'  => 'int',
                'value' => $User->getId(),
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
            // mail($res[0]['mail'], 'Pari entre amis - Chagement de mot de passe', 'Votre nouveau mot de passe est : '.$password);
            // 
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
            unset($password, $req);
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
        $Db  = Database::init();
        $req = "UPDATE user SET mailConfirm = 1 WHERE id = :id AND mail = :mail;";
        $data = array(
            ':id' => array(
                'type'  => 'int',
                'value' => $id
            ),
            ':mail' => array(
                'type'  => 'string',
                'value' => $mail
            )
        );
        $res = $Db->execStatement($req, $data);
        
        return true;
    }
}