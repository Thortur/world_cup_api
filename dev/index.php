<?php
declare (strict_types = 1);
namespace AppApiRest;
header('Content-Type: text/html; charset=UTF-8');
echo '<pre>';
$base = 'lefevrecuv001';
if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $base = 'netfocus';
}

use \DateTime;
use \Connexion\ConfigDataBase;
use \Connexion\Database;
require_once './SendRequete.class.php';
require_once './../app/Autoloader.class.php';
Autoloader::register();
$ConfigDataBase = new ConfigDataBase($base, './../');
$Db = Database::init($ConfigDataBase);

// $SendRequete = new \SendRequete\SendRequete('', array());
// $datas       = $SendRequete->exec();
/*
$listMatch = array(
    2 => array(
        array(
            'date'        => '2018-06-30 16:00:00',
            'teamA'       => 17,
            'teamB'       => 28,
        ),
        array(
            'date'        => '2018-06-30 20:00:00',
            'teamA'       => 32,
            'teamB'       => 20,
        ),
        array(
            'date'        => '2018-07-01 16:00:00',
            'teamA'       => 16,
            'teamB'       => 21,
        ),
        array(
            'date'        => '2018-07-01 20:00:00',
            'teamA'       => 14,
            'teamB'       => 15,
        ),
        array(
            'date'        => '2018-07-02 16:00:00',
            'teamA'       => 29,
            'teamB'       => 26,
        ),
        array(
            'date'        => '2018-07-02 20:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
        array(
            'date'        => '2018-07-03 16:00:00',
            'teamA'       => 23,
            'teamB'       => 24,
        ),
        array(
            'date'        => '2018-07-03 20:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
    ),
    3 => array(
        array(
            'date'        => '2018-07-06 16:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
        array(
            'date'        => '2018-07-06 20:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
        array(
            'date'        => '2018-07-07 16:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
        array(
            'date'        => '2018-07-07 20:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
    ),
    4 => array(
        array(
            'date'        => '2018-07-10 20:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
        array(
            'date'        => '2018-07-11 20:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
    ),
    5 => array(
        array(
            'date'        => '2018-07-14 16:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
    ),
    6 => array(
        array(
            'date'        => '2018-07-15 17:00:00',
            'teamA'       => -1,
            'teamB'       => -1,
        ),
    ),
);

foreach($listMatch as $idTypeMatch => $listMatchParTypeMatch) {
    foreach($listMatchParTypeMatch as $match) {
        $match = (object)$match;
        $Match = new \Match\Match(array(
            'id'            => -1,
            'date'          => $match->date,
            'teamA'         => $match->teamA,
            'scoreTeamA'    => -1,
            'teamB'         => $match->teamB,
            'scoreTeamB'    => -1,
            'idTypeMatch'   => $idTypeMatch,
            'idGroupeMatch' => -1,
        ));
        // var_dump($Match);
        // \Match\MatchManagerMYSQL::insertMatch($Match);
    }
}
unset($idTypeMatch, $listMatchParTypeMatch);
*/
echo '</pre>';