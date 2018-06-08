<?php
declare (strict_types = 1);
namespace worldCup;
use \SendRequete\SendRequete;
header('Content-Type: text/html; charset=UTF-8');
require_once './SendRequete.class.php';

$fct  = 'loadListAllGroupeUserDetail';
$data = array(

);

//send requete
$SendRequete = new SendRequete($fct, $data);
// var_dump($SendRequete);
$reponse     = $SendRequete->exec();

//show resultat
echo '<pre>';
    echo $reponse;
    var_dump($reponse);
    // print_r($reponse);
echo '</pre>';
