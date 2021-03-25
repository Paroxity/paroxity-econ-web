<?php
declare(strict_types = 1);

if(!defined("APP_PATH")){
	define("APP_PATH", dirname(__DIR__) . "/");
}

// needs to be imported first since other classes use its functions
include APP_PATH . "core/functions/util_functions.php";

include APP_PATH . "core/classes/DB.php";
include APP_PATH . "core/functions/functions.php";

ob_start();
session_start();
error_reporting(1);

define("NAME", "ParoxityEcon");
define("URI_NAME", "pecon");

//define("DOMAIN", "http://6710eeb030f1.ngrok.io");
define("DOMAIN", "http://localhost");

define("BASE_URL", DOMAIN . "/" . strtolower(URI_NAME) . "/");
