<?php

if(!defined("APP_PATH")){
	define("APP_PATH", dirname(__DIR__) . "/");
}

include APP_PATH . "core/init.php";

if(!isConnected()){
	home();

	return;
}

disconnect();
home();