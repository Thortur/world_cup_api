<?php
declare (strict_types = 1);
namespace worldCup;
use \SendRequete\SendRequete;
header('Content-Type: text/html; charset=UTF-8');
require_once './SendRequete.class.php';

$fct  = 'insertPari';
$data = array(
    'id'         => -1,
    'idMatch'    => 1,
    'idTypePari' => 1,
    'idUser'     => 1,
    'idCotes'    => 2,
    'montant'    => 23,
    'date'       => '',
);

//send requete
$SendRequete = new SendRequete($fct, $data);
// var_dump($SendRequete);
$reponse     = $SendRequete->exec();

//show resultat
echo '<pre>';
    echo $reponse;
    // var_dump($reponse);
    // print_r($reponse);
echo '</pre>';
