<?php
declare(strict_types = 1);
namespace GroupeUser;
use \Connexion\Database;
include_once 'GroupeUserDetail.class.php';

class GroupeUserDetailManagerMYSQL {
    /**
     * Retourne la liste complete des groupe detail
     * 
     * @return array $listGroupDetail
     */
    public static function loadListAllGroupeUserDetail() {
        $listGroupUserDetail = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM groupe_user_detail";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $GroupeUserDetail = new GroupeUserDetail($data);
                $listGroupUserDetail[] = $GroupeUserDetail->getArray();
            }
            unset($data, $GroupeUserDetail);
        }
        unset($res);
        
        return $listGroupUserDetail;
    }
}