<?php

if(!defined("APP_PATH")){
	define("APP_PATH", dirname(__DIR__) . "/");
}

// needs to be imported first since other classes use its functions
include APP_PATH . "core/functions/util_functions.php";

var_dump(getGetHash());