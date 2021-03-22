<?php
declare(strict_types = 1);

include "functions/util_functions.php"; // needs to be imported first

include "classes/DB.php";
include "functions/functions.php";

ob_start();
session_start();

define("NAME", "ParoxityEcon");
define("URI_NAME", "pecon");
define("BASE_URL", "http://localhost/" . strtolower(URI_NAME) . "/");
