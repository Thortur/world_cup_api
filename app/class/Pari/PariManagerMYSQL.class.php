<?php
declare(strict_types = 1);
namespace Pari;
use \Connexion\Database;
include_once 'Pari.class.php';

class PariManagerMYSQL {

    /**
     * Retourne la liste complete des pari
     * 
     * @return array $listPari
     */
    public static function loadListAllPari() {
        $listPari = array();
        $Db = Database::init();
        $req = "SELECT
                    *
                FROM pari";
        $res = $Db->exec($req);
        if(is_array($res) === true && empty($res) === false) {
            foreach($res as $data) {
                $Pari = new Pari($data);
                $listPari[] = $Pari->getArray();
            }
            unset($data, $Pari);
        }
        unset($res);
        return $listPari;
    }

    /**
     * On check si le user a deja parié sur le match
     * 
     * @param Pari $Pari
     * @return int $idPari
     */
    public static function isDejaPariMatch(Pari $Pari) {
        $idPari = -1;
        $Db = Database::init();
        $req = "SELECT
                    pari.id
                FROM pari
                WHERE
                    pari.idMatch = :idMatch
                    AND pari.idUser = :idUser
                    AND pari.idTypePari = :idTypePari";
        
        $data = array(
            ':idMatch' => array(
                'type'  => 'int',
                'value' => $Pari->getIdMatch(),
            ),
            ':idTypePari' => array(
                'type'  => 'int',
                'value' => $Pari->getIdTypePari(),
            ),
            ':idUser' => array(
                'type'  => 'int',
                'value' => $Pari->getIdUser(),
            ),
        );
        $res = $Db->execStatement($req, $data);
        unset($req, $data, $Pari);
        if(empty($res[0]['id']) === false) {
            $idPari = (int)$res[0]['id'];
        }
        return $idPari;
    }

    /**
     * Insert un nouveau parisur un match
     * 
     * @param Pari $Pari
     * @return int nb ligne
     */
    public static function insertPari(Pari $Pari) {
        $Db = Database::init();
        
        $req = "INSERT INTO pari (idMatch, idTypePari, idUser, idCotes, montant, date) VALUES (:idMatch, :idTypePari, :idUser, :idCotes, :montant, :date);";
        $data = array(
            ':idMatch' => array(
                'type'  => 'int',
                'value' => $Pari->getIdMatch(),
            ),
            ':idTypePari' => array(
                'type'  => 'int',
                'value' => $Pari->getIdTypePari(),
            ),
            ':idUser' => array(
                'type'  => 'int',
                'value' => $Pari->getIdUser(),
            ),
            ':idCotes' => array(
                'type'  => 'int',
                'value' => $Pari->getIdCotes(),
            ),
            ':montant' => array(
                'type'  => 'float',
                'value' => $Pari->getMontant(),
            ),
            ':date' => array(
                'type'  => 'string',
                'value' => $Pari->getDate()->format('Y-m-d H:i:s'),
            ),
        );
        
        $Db->execStatement($req, $data);
        unset($req, $data);
        $Pari->setId($Db->getLastInsertId());
        
        return $Pari;
    }

    /**
     * Mise a jour d'un pari
     * 
     * @param Pari $Pari
     * @return int nbligne
     */
    public static function updatePari(Pari $Pari) {
        $Db = Database::init();
        $req = "UPDATE pari SET idCotes = :idCotes, montant = :montant, date = :date WHERE idMatch = :idMatch AND idTypePari = :idTypePari AND idUser = :idUser";
        $data = array(
            ':idMatch' => array(
                'type'  => 'int',
                'value' => $Pari->getIdMatch(),
            ),
            ':idTypePari' => array(
                'type'  => 'int',
                'value' => $Pari->getIdTypePari(),
            ),
            ':idUser' => array(
                'type'  => 'int',
                'value' => $Pari->getIdUser(),
            ),
            ':idCotes' => array(
                'type'  => 'int',
                'value' => $Pari->getIdCotes(),
            ),
            ':montant' => array(
                'type'  => 'float',
                'value' => $Pari->getMontant(),
            ),
            ':date' => array(
                'type'  => 'string',
                'value' => $Pari->getDate()->format('Y-m-d H:i:s'),
            ),
        );
        
        $Db->execStatement($req, $data);
        unset($req, $data);
        return $Pari;
    }
}