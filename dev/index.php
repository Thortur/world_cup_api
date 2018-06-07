<?php
declare (strict_types = 1);
namespace worldCup;
use \SendRequete\SendRequete;
header('Content-Type: text/html; charset=UTF-8');
require_once './SendRequete.class.php';

$fct  = 'createUser';
$data = array(

);

//send requete
$SendRequete = new SendRequete($fct, $data);
$reponse     = $SendRequete->exec();

//show resultat
// echo $reponse;
echo '<pre>';
    var_dump($reponse);
echo '</pre>';
