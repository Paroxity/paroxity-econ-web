<?php
declare(strict_types = 1);

if(!defined("APP_PATH")){
	define("APP_PATH", dirname(__DIR__) . "/");
}

include APP_PATH . "core/init.php";

if(isset($_POST["submit"])){
	$_SESSION["host"] = $_POST["host"];
	$_SESSION["username"] = $_POST["username"];
	$_SESSION["password"] = $_POST["password"];
	$_SESSION["schema"] = $_POST["schema"];

	if(!isConnected()){
		if(DB::INIT()){
			_alert("CONNECTED SUCCESSFULLY");
			$_SESSION["connected"] = true;

			// NOT REALLY NECESSARY TBH
			// user connected successfully, send them to connect page
            // the connect gate serves as a security layer
            // all redirects are to first go through the connect page

            $_SESSION["redirect"] = "currency"; // we only deal with currency changes for now

			_go("connect");
		}else{
			unset($_SESSION["connected"]);
			_alert("Unable to establish connection. Please try again.");
		}
	}

	unset($_POST["submit"]);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo NAME; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Blinker">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo _resource("assets/bootstrap/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/fonts/fontawesome-all.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/fonts/font-awesome.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/fonts/fontawesome5-overrides.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/css/fixed-div-scrolling.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/css/footer.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/css/navbar.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/css/styles.css"); ?>">
    <link rel="stylesheet" href="<?php echo _resource("assets/css/table-custom.css"); ?>">
</head>

<body>
<div id="header">
    <header>
        <div class="container-fluid" id="header-2">
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="height: 106px;padding: 29px;text-align: center;">
                <div class="container"><a class="navbar-brand" style="color: rgb(255,255,255);">PAROXITY<br></a><button data-toggle="collapse" class="navbar-toggler custom-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon" style="color:white;"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#features">Features</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#team">Team</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#about-us">About</a></li>
                        </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" data-toggle="modal" data-bss-tooltip="" data-bss-hover-animate="pulse" id="connect-btn" href="#" data-target="#connect" title="Connect to your database and start editing">Connect</a><a class="btn btn-light action-button" role="button" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="pulse" id="disconnect-btn" href="<?php echo _url("disconnect"); ?>" title="Disconnect from the database">Disconnect</a></span>
                    </div>
                </div>
            </nav>
            <div class="custom-modal">
                <div class="modal fade" role="dialog" tabindex="-1" id="features">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content" style="background-color: #1A1A1D;">
                            <div class="modal-header" style="background: #1a1a1d;border-color: #ffffff;">
                                <h4 class="modal-title" style="color: rgb(255,255,255);">Features</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body border-0" style="background: #1a1a1d;">
                                <p style="color: rgb(255,255,255);">&nbsp;* Everything is async so economy won't lag your server.<br>&nbsp;* MYSQL and SQLite support.<br>&nbsp;* Multiple currency support.<br>&nbsp;* Keep track of users money using their UUID and username.<br>&nbsp;* Simple API for developers.<br>&nbsp;* Cache support! For display purposes only tho.<br>&nbsp;* In-built Forms support.<br>&nbsp;* Simple and neat commands with permissions.<br>&nbsp;* A website to display users money (planned/not complete).<br></p>
                            </div>
                            <div class="modal-footer" style="background: #1a1a1d;"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" role="dialog" tabindex="-1" id="team">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content" style="background-color: #1A1A1D;">
                            <div class="modal-header" style="background: #1a1a1d;border-color: #ffffff;">
                                <h4 class="modal-title" style="color: rgb(255,255,255);">Paroxity Team</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body border-0" style="background: #1a1a1d;">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-columns">
                                            <div class="card"><img class="img-fluid card-img-top w-100 d-block" src="https://avatars.githubusercontent.com/u/32965703?s=460&amp;u=ab606a81e9203f5a480680aac3c5cbb367c9ea69&amp;v=4" loading="lazy" alt="Ifera">
                                                <div class="card-body">
                                                    <h4 class="card-title"><strong>Ifera</strong></h4>
                                                    <p class="card-text">WEB, LEAD DEV&nbsp;</p><a class="card-link" href="https://github.com/Ifera" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button" url="https://github.com/Ifera"><i class="fa fa-github"></i></button></a><a class="card-link" href="https://twitter.com/ifera_tr" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button"><i class="fa fa-twitter"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="Ifera#3717"><i class="fab fa-discord"></i></button></a>
                                                </div>
                                            </div>
                                            <div class="card"><img class="img-fluid card-img-top w-100 d-block" src="https://avatars.githubusercontent.com/u/8540562?s=460&amp;u=6a21505b092244f64b0830b308f058f733dd7403&amp;v=4" loading="lazy" alt="DaPigGuy">
                                                <div class="card-body">
                                                    <h4 class="card-title"><strong>DaPigGuy</strong></h4>
                                                    <p class="card-text">WEB, SENIOR DEV</p><a class="card-link" href="https://github.com/DaPigGuy" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button" url="https://github.com/Ifera"><i class="fa fa-github"></i></button></a><a class="card-link" href="https://twitter.com/DaPigGuy" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button"><i class="fa fa-twitter"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="DaPigGuy#4580"><i class="fab fa-discord"></i></button></a>
                                                </div>
                                            </div>
                                            <div class="card"><img class="img-fluid card-img-top w-100 d-block" src="https://avatars.githubusercontent.com/u/16523741?s=460&amp;u=ac821e13dbfe77c59db0220176bcf1c643fd1e6f&amp;v=4" alt="Aericio" loading="lazy">
                                                <div class="card-body">
                                                    <h4 class="card-title"><strong>Aericio</strong></h4>
                                                    <p class="card-text">MANAGER, DEV</p><a class="card-link" href="https://github.com/Aericio" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button" url="https://github.com/Ifera"><i class="fa fa-github"></i></button></a><a class="card-link" href="https://twitter.com/xAericio" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button"><i class="fa fa-twitter"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="Aericio#4684"><i class="fab fa-discord"></i></button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-columns">
                                            <div class="card"><img class="img-fluid card-img-top w-100 d-block" src="https://avatars.githubusercontent.com/u/30378179?s=460&amp;u=49eabab31601b6bf5b0024c05c2556bc7f5b3e3b&amp;v=4" loading="lazy" alt="TwistedAsylumMC">
                                                <div class="card-body">
                                                    <h4 class="card-title"><strong>TwistedAsylumMC</strong></h4>
                                                    <p class="card-text">PROXY, LEAD DEV</p><a class="card-link" href="https://github.com/TwistedAsylumMC" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button" url="https://github.com/Ifera"><i class="fa fa-github"></i></button></a><a class="card-link" href="https://twitter.com/ImNotTwisted" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button"><i class="fa fa-twitter"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="TwistedAsylum#6246"><i class="fab fa-discord"></i></button></a>
                                                </div>
                                            </div>
                                            <div class="card"><img class="img-fluid card-img-top w-100 d-block" src="https://avatars.githubusercontent.com/u/17936976?s=460&amp;u=86e8276d7dc06a4544afe97e591a972c487093e6&amp;v=4" loading="lazy" alt="NeutronicMC">
                                                <div class="card-body">
                                                    <h4 class="card-title"><strong>NeutronicMC</strong></h4>
                                                    <p class="card-text">SENIOR WEB DEV</p><a class="card-link" href="https://github.com/NeutronicMC" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button" url="https://github.com/Ifera"><i class="fa fa-github"></i></button></a><a class="card-link" href="https://twitter.com/NeutronicMC" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button"><i class="fa fa-twitter"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="Neutronic#6933"><i class="fab fa-discord"></i></button></a>
                                                </div>
                                            </div>
                                            <div class="card"><img class="img-fluid card-img-top w-100 d-block" src="https://avatars.githubusercontent.com/u/45741122?s=460&amp;u=1aae3bb21228d8fed845fb143763d4145c3fb260&amp;v=4" alt="T14Raptor" loading="lazy">
                                                <div class="card-body">
                                                    <h4 class="card-title"><strong>T 14Raptor</strong></h4>
                                                    <p class="card-text">PROXY DEV</p><a class="card-link" href="https://github.com/T14Raptor" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button" url="https://github.com/Ifera"><i class="fa fa-github"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="Doesn't have twitter ;("><i class="fa fa-twitter"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="T 14Raptor#0001"><i class="fab fa-discord"></i></button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-columns">
                                            <div class="card"><img class="img-fluid card-img-top w-100 d-block" src="https://avatars.githubusercontent.com/u/34463340?s=460&amp;u=cb6277e3ce7a7b57905d05639faa19d63e860bb0&amp;v=4" loading="lazy" alt="NTMNathan">
                                                <div class="card-body">
                                                    <h4 class="card-title"><strong>Nate</strong></h4>
                                                    <p class="card-text">DISCORD BOT DEV</p><a class="card-link" href="https://github.com/NTMNathan" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button" url="https://github.com/Ifera"><i class="fa fa-github"></i></button></a><a class="card-link" href="https://twitter.com/ntm_nathan" target="_blank"><button class="btn btn-lg text-left" data-bss-hover-animate="tada" type="button"><i class="fa fa-twitter"></i></button></a><a class="card-link" href="#"><button class="btn btn-lg text-left" data-toggle="tooltip" data-bss-tooltip="" data-bss-hover-animate="tada" type="button" title="NTM Nathan#0001"><i class="fab fa-discord"></i></button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="background: #1a1a1d;"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" role="dialog" tabindex="-1" id="about-us">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="background-color: #1A1A1D;">
                            <div class="modal-header" style="background: #1a1a1d;border-color: #ffffff;">
                                <h4 class="modal-title" style="color: rgb(255,255,255);">About</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body border-0" style="background: #1a1a1d;">
                                <p style="color: rgb(255,255,255);"><strong>ParoxityEcon </strong>- An economy plugin for PocketMine-MP servers. Unlike other economy plugins currently available, ParoxityEcon is the <strong>first</strong> of its kind which is designed for server networks. But that does not mean that its limited to networks. It can function just fine for normal servers. With an easy to use API and constant development, the<strong> future looks promising</strong> for ParoxityEcon.</p>
                            </div>
                            <div class="modal-footer" style="background: #1a1a1d;"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" role="dialog" tabindex="-1" id="connect">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content" style="background-color: #1A1A1D;">
                            <div class="modal-header" style="background: #1a1a1d;border-color: #ffffff;">
                                <h4 class="modal-title" style="color: rgb(255,255,255);">Connect</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body border-0" style="background: #1a1a1d;">
                                <form method="POST" name="connect" action="index.php">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fa fa-sitemap fa-fw"></i></span></div><input class="form-control" type="text" placeholder="Host" required="" name="host">
                                            <div class="input-group-append"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fas fa-user fa-fw"></i></span></div><input class="form-control" type="text" placeholder="Username" required="" name="username">
                                            <div class="input-group-append"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fas fa-lock fa-fw"></i></span></div><input class="form-control" type="password" placeholder="Password" name="password">
                                            <div class="input-group-append"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fas fa-database fa-fw"></i></span></div><input class="form-control" type="text" placeholder="Schema" required="" name="schema">
                                            <div class="input-group-append"></div>
                                        </div>
                                    </div>
                                    <hr style="background: var(--light);">
                                    <div class="form-group text-right"><button class="btn btn-outline-dark btn-lg text-white" style="width: 100%;" type="submit" name="submit">Connect</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
