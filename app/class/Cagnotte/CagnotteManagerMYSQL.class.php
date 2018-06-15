<?php
declare(strict_types = 1);
namespace Cagnotte;
use \Connexion\Database;
include_once 'Cagnotte.class.php';
include_once 'CagnotteManager.class.php';

class CagnotteManagerMYSQL {
    /**
     * Insert cagnotte
     */
    public static function insertCagnotte(Cagnotte $Cagnotte) {
        $Db   = Database::init();
        $req  = "INSERT INTO cagnotte (idUser, idPari, date, montant) VALUES (:idUser, :idPari, :date, :montant);";
        $data = array(
            ':idUser' => array(
                'type'  => 'int',
                'value' => $Cagnotte->getIdUser(),
            ),
            ':idPari' => array(
                'type'  => 'int',
                'value' => $Cagnotte->getIdPari(),
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
     * Chargement de tout les cagnottes d'un user
     * 
     * @return array $listCagnotte
     */
    public static function loadCagnotteUser(int $idUser) {
        $listCagnotte = array();
        $Db = Database::init();
        $req = "SELECT
                *
                FROM cagnotte
                WHERE
                    cagnotte.idUser = :idUser";
        $data = array(
            ':idUser' => array(
                'type'  => 'int',
                'value' => $idUser,
            ),
        );
        $res = $Db->execStatement($req, $data);
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
                $listCagnotte[$Cagnotte->getIdUser()][] = $Cagnotte->getArray();
            }
            unset($data, $Cagnotte);
        }
        unset($res);

        return $listCagnotte;
    }
}