<?php
declare(strict_types = 1);

include "./core/init.php";

if(isset($_POST["submit"])){
	$_SESSION["host"] = $host = $_POST["host"];
	$_SESSION["username"] = $username = $_POST["username"];
	$_SESSION["password"] = $password = $_POST["password"];
	$_SESSION["schema"] = $schema = $_POST["schema"];


	if(!isConnected()){
		if(DB::INIT()){
			_alert("CONNECTED SUCCESSFULLY");
			$_SESSION["connected"] = true;
		}else{
			unset($_SESSION["connected"]);
			_alert("Unable to establish connection. Please try again.");
		}
	}

	unset($_POST["submit"]);
}