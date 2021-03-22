<?php
declare(strict_types = 1);

function checkInput($str): string{
	$str = htmlspecialchars($str);
	$str = trim($str);
	$str = stripslashes($str);

	return $str;
}

function home(): void{
	header("Location: " . BASE_URL);
	exit();
}

function _alert(string $msg): void{
	echo '<script type = "text/javascript"> alert("' . $msg . '") </script>';
}

function _log(string $msg): void{
	echo '<script type = "text/javascript"> console.log("' . $msg . '") </script>';
}

function isConnected(): bool{
	return isset($_SESSION["connected"]);
}

function disconnect(): void{
	DB::DESTROY();
	session_destroy();
}