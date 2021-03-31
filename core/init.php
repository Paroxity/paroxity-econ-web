<?php
declare(strict_types = 1);

if(!defined("APP_PATH")){
	define("APP_PATH", dirname(__DIR__) . "/");
}

// set this to true when the site is running on production server
define("IN_PRODUCTION", true);

// needs to be imported first since other classes use its functions
include APP_PATH . "core/functions/util_functions.php";

include APP_PATH . "core/classes/DB.php";
include APP_PATH . "core/functions/functions.php";

ob_start();
session_start();
error_reporting(1);

define("NAME", "ParoxityEcon");

// BASE_FOLDER: the name of the folder the website is in, set to . if none
// DOMAIN: pretty self explanatory, the web address to this website
// BASE_URL: combination of DOMAIN and BASE_FOLDER

if(IN_PRODUCTION){
	define("BASE_FOLDER", ".");
	define("DOMAIN", "https://econ.paroxity.net");
	define("BASE_URL", DOMAIN . "/" . strtolower(BASE_FOLDER) . "/");
}else{
	define("BASE_FOLDER", "pecon");
	define("DOMAIN", "http://localhost");
	define("BASE_URL", DOMAIN . "/");
}