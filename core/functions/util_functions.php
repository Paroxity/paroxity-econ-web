<?php
declare(strict_types = 1);

// strips the special character, spaces, slashes from the argument
function stripInput($str): string{
	$str = htmlspecialchars($str);
	$str = trim($str);
	$str = stripslashes($str);

	return $str;
}

// returns if the user is connected or not
function isConnected(): bool{
	return isset($_SESSION["connected"]);
}

// return the last known git commit hash or 0000000 in case of error
function getGitHash(string $branch = "master"): string{
	$hash = file_get_contents(sprintf(APP_PATH . ".git/refs/remotes/origin/%s", $branch));

	if(!$hash){
		return str_repeat("0", 7);
	}
	return substr(stripInput($hash), 0, 7);
}

// proceed to the home page of the website
function _home(): void{
	header("Location: " . BASE_URL);
	exit();
}

// show an alert via js
function _alert(string $msg): void{
	echo '<script type = "text/javascript"> alert("' . $msg . '") </script>';
}

// log stuff to console
function _log($msg): void{
	echo '<script type = "text/javascript"> console.log("' . $msg . '") </script>';
}

// display error on top of the header
function _error(string $err): void{
	$_SESSION["alert-error"] = $err;
}

// display success message on top of the header
function _success(string $msg): void{
	$_SESSION["alert-success"] = $msg;
}

function _temp_success_msg(string $msg): void{
	$_SESSION["temp-msg"]["success"] = $msg;
}

function _temp_error_msg(string $err): void{
	$_SESSION["temp-msg"]["error"] = $err;
}

// disconnect the user from the db and destroy the session if needed
function _disconnect(bool $destroySession = true): void{
	DB::DESTROY();
	unset($_SESSION["connected"]);
	if($destroySession) session_destroy();
}

// To be used for paths that could be accessed via web
function _resource(string $path): string{
	return "/" . BASE_FOLDER . "/" . $path;
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

// wait x seconds before redirecting
function _redirect(string $path, int $sec = 5): void{
	header("refresh: ${sec}; url= " . BASE_URL . $path);
	exit();
}