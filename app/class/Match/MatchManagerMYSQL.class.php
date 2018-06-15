<?php
declare(strict_types = 1);
namespace Match;
use \Connexion\Database;
include_once 'Match.class.php';

class MatchManagerMYSQL {
    /**
     * Retourne la liste complete des match
     * 
     * @return array $listMatch
     */
    public static function loadListAllMatch() {
        $listMatch = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM `match`
                ORDER BY `match`.date";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $Match = new Match($data);
                $listMatch[$Match->getId()] = $Match->getArray();
            }
            unset($data, $Match);
        }
        unset($res);

        return $listMatch;
    }
     /**
     * Retourne des datas sur le match
     * 
     * @param int $idMatch
     * @return Match $Match
     */
    public static function loadMatch(int $idMatch) {
        $Match = false;
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM `match`
                WHERE `match`.id = :idMatch;";
        $data = array(
            ':idMatch' => array(
                'type' => 'int',
                'value' => $idMatch,
            ),
            
        );
        $res = $Db->execStatement($req, $data);
        if(is_array($res) === true && empty($res) === false) {
            $Match = new Match($res[0]); 
        }
        unset($res);

        return $Match;
    }
}