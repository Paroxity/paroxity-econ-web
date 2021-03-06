<?php

if(!defined("APP_PATH")){
	define("APP_PATH", dirname(__DIR__) . "/");
}

include APP_PATH . "includes/header.php";

if(!isConnected() || !isset($_SESSION["redirect"])){
	_home();

	return;
}

if(isset($_SESSION["temp-msg"])){
    if(isset($_SESSION["temp-msg"]["success"])){
	    _success($_SESSION["temp-msg"]["success"]);
	    unset($_SESSION["temp-msg"]["success"]);
    }

	if(isset($_SESSION["temp-msg"]["error"])){
		_error($_SESSION["temp-msg"]["error"]);
		unset($_SESSION["temp-msg"]["error"]);
	}
}

_go($_SESSION["redirect"]);

?>

    <div id="content">
        <div class="window-center">
            <div>
                <h1 class="display-4 text-center content-title" style="color: rgb(195, 7, 63);">CONNECT PAGE</h1>
                <h1 class="content-subtitle" style="padding: 10px;font-size: 14px;padding-right: 0px;padding-left: 0px;">A first of its kind economy plugin for PocketMine-MP servers&nbsp;</h1>
            </div>
        </div>
    </div>

<?php include APP_PATH . "includes/footer.php"; ?>