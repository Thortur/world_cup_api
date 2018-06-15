<?php
declare(strict_types = 1);
namespace Team;
use \Connexion\Database;
include_once 'Team.class.php';

class TeamManagerMYSQL {

    /**
     * Retourne la liste complete des teams
     * 
     * @return array $listTeam
     */
    public static function loadListAllTeam() {
        $listTeam = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM team";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $Team = new Team($data);
                $listTeam[$Team->getId()] = $Team->getArray();
            }
            unset($data, $Team);
        }
        unset($res);
        return $listTeam;
    }
}