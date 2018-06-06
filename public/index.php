<?php
declare (strict_types = 1);
namespace AppApiRest;
header('Content-Type: text/html; charset=UTF-8');


use \DateTime;
use \Connexion\ConfigDataBase;
use \Connexion\Database;

require_once './../app/Autoloader.class.php';
Autoloader::register();
$ConfigDataBase = new ConfigDataBase('lefevrecuv001', './../');
$Db = Database::init($ConfigDataBase);

// Initiiate Library
$api = new ApiApp();
$api->processApi();