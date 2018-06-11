<?php
declare(strict_types = 1);
namespace Resultat;
use \Connexion\Database;
include_once 'Resultat.class.php';

class ResultatManagerMYSQL {

    /**
     * Retourne la liste complete des resultats des matchs
     * 
     * @return array $listResultat
     */
    public static function loadListAllResultat() {
        $listResultat = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM resultat";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $Resultat = new Resultat($data);
                $listResultat[$Resultat->getIdMatch()][$Resultat->getIdTeam()] = $Resultat->getScore();
            }
            unset($data, $Resultat);
        }
        unset($res);
        return $listResultat;
    }
}