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
    
    public static function insertMatch(Match $Match) {
        $Db = Database::init();
        $req = "INSERT INTO `match` (date, teamA, teamB, idTypeMatch, idGroupeMatch) VALUES (:date, :teamA, :teamB, :idTypeMatch, :idGroupeMatch);";
        $data = array(
                    ':date' => array(
                        'type' => 'string',
                        'value' => $Match->getDate()->format('Y-m-d H:i:s'),
                    ),
                    ':teamA' => array(
                        'type' => 'int',
                        'value' => $Match->getTeamA(),
                    ),
                    ':teamB' => array(
                        'type' => 'int',
                        'value' => $Match->getTeamB(),
                    ),
                    ':idTypeMatch' => array(
                        'type' => 'int',
                        'value' => $Match->getIdTypeMatch(),
                    ),
                    ':idGroupeMatch' => array(
                        'type' => 'int',
                        'value' => $Match->getIdGroupeMatch(),
                    ),
                );
        $Db->execStatement($req, $data);
        $Match->setId($Db->getLastInsertId());
        unset($req, $data);

        return $Match;
    }
}