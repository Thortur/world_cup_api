<?php
declare (strict_types = 1);
namespace worldCup;
use \SendRequete\SendRequete;
header('Content-Type: text/html; charset=UTF-8');
require_once './SendRequete.class.php';

$fct  = 'loadMatch';
$data = array(
    'idMatch' => 1,
);

// $fct  = 'saveResultatMatch';
// $data = array(
//     'idMatch'    => 1,
//     'idTeamA'    => 21,
//     'scoreTeamA' => 5,
//     'idTeamB'    => 6,
//     'scoreTeamB' => 0,
// );

$fct  = 'loginUser';
$data = array(
    'pseudo'   => (string)$_POST['pseudo'],
    'password' => (string)$_POST['password'],
);

//send requete
$SendRequete = new SendRequete($fct, $data);
$reponse     = $SendRequete->exec();

// show resultat
echo '<pre>';
    echo $reponse;
    var_dump($reponse);
    print_r($reponse);
echo '</pre>';

