<?php
declare (strict_types = 1);
namespace AppApiRest;
header('Content-Type: text/html; charset=UTF-8');

// use \DateTime;
// use \Connexion\ConfigDataBase;
// use \Connexion\Database;
// use \Team\TeamManagerMYSQL;
// use \User\User;
// use \User\UserManagerMYSQL;
// use \TypeMatch\TypeMatchManagerMYSQL;
// use \TypePari\TypePariManagerMYSQL;
// use \Match\MatchManagerMYSQL;
// use \Match\Match;
// use \GroupeMatch\GroupeMatchManagerMYSQL;
// use \GroupeMatchDetail\GroupeMatchDetailManagerMYSQL;
// use \Cotes\CotesManagerMYSQL;
// use \Cotes\Cotes;


require_once './../app/Autoloader.class.php';
Autoloader::register();
$ConfigDataBase = new ConfigDataBase('netfocus', './../');
$Db = Database::init($ConfigDataBase);

// echo 'coucou';
/*
// initialisation
$ch = curl_init( );

// configuration
curl_setopt( $ch, CURLOPT_URL, 'https://www.betclic.fr/football/coupe-du-monde-e1' );
curl_setopt( $ch, CURLOPT_HEADER, true );

// récupération du fichier
$page = curl_exec( $ch );
var_dump($page);
if($page === false) {
    trigger_error(curl_error($ch));
}
// libération de la ressource
curl_close( $ch );

// var_dump($page);
//*/
// $User = UserManagerMYSQL::connexion('Thortur', 'Mendy!2');

// if($User instanceof User) {
//     echo 'Oui<br/>';
// }
// else {
//     echo 'Non<br/>';
// }
// $listUser = UserManagerMYSQL::loadListAllTeam();

// $User = new User(array(
//     'id'      => null,
//     'nom'      => 'LefÃ¨vre',
//     'prenom'   => 'Christophe',
//     'pseudo'   => 'Thortur',
//     'mail'     => 'lefevre.christophe@outlook.com',
//     'password' => 'Mendy!',
// ));

// $User = UserManagerMYSQL::createUser($User);
// var_dump($User);
// UserManagerMYSQL::updateUser($User);
// UserManagerMYSQL::updatePassWord($User);
// var_dump($res);
// $listTeam = TeamManagerMYSQL::loadListAllTeam();
// var_dump($listTeam);
// $listTypeMatch = TypeMatchManagerMYSQL::loadListAllTypeMatch();
// var_dump($listTypeMatch);
// $listTypeMatch = TypePariManagerMYSQL::loadListAllTypePari();
// var_dump($listTypeMatch);
// $listMatch = MatchManagerMYSQL::loadListAllMatch();
// var_dump($listMatch);
// $listGroup = GroupeMatchManagerMYSQL::loadListAllGroupe();
// var_dump($listGroup);
// $listGroup = GroupeMatchDetailManagerMYSQL::loadListAllGroupeDetail();
// var_dump($listGroup);
// $dateNow = new DateTime();
// $dateNow->setTime(12, 34, 38);
// $Cotes = new Cotes(array(
//     'id'         => null,
//     'idMatch'    => 1,
//     'idTypePari' => 1,
//     'idTeam'     => 1,
//     'cote'       => 3,
//     'date'       => $dateNow->format('Y-m-d H:i:s'),
// ));
// CotesManagerMYSQL::insertCotes($Cotes);
// $Cotes = new Cotes(array(
//     'id'         => null,
//     'idMatch'    => 1,
//     'idTypePari' => 1,
//     'idTeam'     => 2,
//     'cote'       => 9.3,
//     'date'       => $dateNow->format('Y-m-d H:i:s'),
// ));
// CotesManagerMYSQL::insertCotes($Cotes);
// $Cotes = new Cotes(array(
//     'id'         => null,
//     'idMatch'    => 1,
//     'idTypePari' => 1,
//     'idTeam'     => 0,
//     'cote'       => 6.7,
//     'date'       => $dateNow->format('Y-m-d H:i:s'),
// ));
// CotesManagerMYSQL::insertCotes($Cotes);
// var_dump($dateNow);
// CotesManagerMYSQL::loadLastCotesToDate($dateNow);
// $Match = new Match(array(
//     'id'   => 1,
//     'date' => '2018-06-14 18:00:00',
//     'teamA' => 21,
//     'teamB' => 26,
//     'idTypeMatch' => 1,
//     'idGroupeMatch' => 1,
// ));

// $listCotes = CotesManagerMYSQL::loadLastCoteMatch($Match);
// var_dump($listCotes);

// Initiiate Library
// $api = new ApiApp();
// $api->processApi();


// $req = "SELECT
//             *
//         FROM utilisateurs
//         WHERE
//             utilisateurs.id_organisation = :idOrg AND (utilisateurs.id_organisation = :idOrg OR utilisateurs.id_organisation = :idOrg) AND utilisateurs.id_organisation = :idOrg AND utilisateurs.id_organisation IN (:idOrg, :idOrg)
//             ORDER BY utilisateurs.id_organisation";
// $res = $Db->execStatement($req, 
//                             array(
//                                 ':idOrg' => array(
//                                                 'type' => 'int',
//                                                 'value' => 28025,
//                                             )
//                                 ),
//                             array(
//                                 'methode'    => 'fetchAll',
//                                 'fetchStyle' => 'FETCH_OBJ',
//                             ));
// echo '<pre>';
//     var_dump($res);
// echo '</pre>';
