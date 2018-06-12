<?php
declare(strict_types = 1);
namespace Cagnotte;
use \Connexion\Database;
include_once 'Cagnotte.class.php';

class CagnotteManagerMYSQL {
    /**
     * Insert cagnotte
     */
    public static function insertCagnotte(Cagnotte $Cagnotte) {
        $Db   = Database::init();
        $req  = "INSERT INTO cagnotte (idUser, date, montant) VALUES (:idUser, :date, :montant);";
        $data = array(
            ':idUser' => array(
                'type'  => 'int',
                'value' => $Cagnotte->getIdUser(),
            ),
            ':date' => array(
                'type'  => 'string',
                'value' => $Cagnotte->getDate()->format('Y-m-d H:i:s'),
            ),
            ':montant' => array(
                'type'  => 'float',
                'value' => $Cagnotte->getMontant(),
            ),
        );
        $res = $Db->execStatement($req, $data);
        unset($req, $data);
        $Cagnotte->setId($Db->getLastInsertId());

        return $Cagnotte;
    }

    /**
     * Chargement de tout les cagnottes
     * 
     * @return array $listCagnotte
     */
    public static function loadAllCagnotte() {
        $listCagnotte = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM cagnotte";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $Cagnotte = new Cagnotte($data);
                $listCagnotte[] = $Cagnotte->getArray();
            }
            unset($data, $Cagnotte);
        }
        unset($res);

        return $listCagnotte;
    }
}