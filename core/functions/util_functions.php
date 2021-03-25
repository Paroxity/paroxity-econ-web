<?php
declare(strict_types = 1);

// strips the special character, spaces, slashes from the argument
function stripInput($str): string{
	$str = htmlspecialchars($str);
	$str = trim($str);
	$str = stripslashes($str);

	return $str;
}

// proceed to the home page of the website
function home(): void{
	header("Location: " . BASE_URL);
	exit();
}

// show an alert via js
function _alert(string $msg): void{
	echo '<script type = "text/javascript"> alert("' . $msg . '") </script>';
}

// log stuff to console
function _log(string $msg): void{
	echo '<script type = "text/javascript"> console.log("' . $msg . '") </script>';
}

function isConnected(): bool{
	return isset($_SESSION["connected"]);
}

// disconnect the user from the db and destroy the session if needed
function disconnect(bool $destroySession = true): void{
	DB::DESTROY();
	unset($_SESSION["connected"]);
	if($destroySession) session_destroy();
}

// To be used for paths that could be accessed via web
function _resource(string $path): string{
	return "/" . URI_NAME . "/" . $path;
}

// returns the url to the desired path prefixed with the websites address
function _url(string $path): string{
	return BASE_URL . $path;
}

// particular use case involves inclusions..
function _path(string $path): string{
	return APP_PATH . $path;
}

// head over to another page
function _go(string $path): void{
	header("Location: " . BASE_URL . $path);
	exit();
}