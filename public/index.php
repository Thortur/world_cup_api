<?php
declare (strict_types = 1);
namespace AppApiRest;
header('Content-Type: text/html; charset=UTF-8');

$base = 'lefevrecuv001';
if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $base = 'netfocus';
}

use \DateTime;
use \Connexion\ConfigDataBase;
use \Connexion\Database;

require_once './../app/Autoloader.class.php';
Autoloader::register();
$ConfigDataBase = new ConfigDataBase($base, './../');
$Db = Database::init($ConfigDataBase);

// Initiiate Library
$api = new ApiApp();
$api->processApi();