<?php
declare(strict_types = 1);
namespace TypeMatch;
use \Connexion\Database;
include_once 'TypeMatch.class.php';

class TypeMatchManagerMYSQL {
    /**
     * Retourne la liste des type de match
     * 
     * @return array $listTypeMatch
     */
    public static function loadListAllTypeMatch() {
        $listTypeMatch = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM type_match";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $TypeMatch = new TypeMatch($data);
                $listTypeMatch[$TypeMatch->getId()] = $TypeMatch->getArray();
            }
            unset($data, $TypeMatch);
        }
        unset($res);

        return $listTypeMatch;
    }
}