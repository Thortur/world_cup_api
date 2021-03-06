<?php
declare(strict_types = 1);
namespace GroupeUser;
use \Connexion\Database;
include_once 'GroupeUser.class.php';

class GroupeUserManagerMYSQL {
    /**
     * Retourne la liste complete des groupe
     * 
     * @return array $listGroup
     */
    public static function loadListAllGroupeUser() {
        $listGroup = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM groupe_user";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $GroupeUser = new GroupeUser($data);
                $listGroup[$GroupeUser->getId()] = $GroupeUser->getArray();
            }
            unset($data, $GroupeUser);
        }
        unset($res);

        return $listGroup;
    }
}