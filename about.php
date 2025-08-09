<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php?redir=/about.php%20noAuth");
        exit;
}
?>
<!DOCTYPE html>
<html lang="de-De">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style-startMenuIndex.css">
    <link rel="stylesheet" href="./src/mdl/style-mdl.css">
    <link rel="stylesheet" href="./src/mdl/style-googleAPI.css">
    <link rel="stylesheet" href="./src/css/style-about.css">
    <script src="./src/mdl/script-mdl.js"></script>
    <link rel="icon" type="image/x-icon" href="./src/img/mtLogo.png">
    <title>Über</title>
</head>
<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title"><a class="backBtn" href="./index.php?redir=/about.php%20loc=nav">Medientutoren Portal&nbsp;</a><b>-&nbsp;Version</b></span>
                <div class="mdl-layout-spacer"></div>
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link" href="./history/index.php?redir=/about.php%20loc=nav">Abmelden&nbsp;<a class="logout" href="./logout.php?redir=/about.php%20loc=nav">🚪</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Menü</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="./index.php?redir=/about.php%20loc=nav">HOME</a>
                <a class="mdl-navigation__link" href="./RaumCheck/index.php?redir=/about.php%20loc=nav">Raum Check</a>
                <a class="mdl-navigation__link" href="./ToDo/index.php?redir=/about.php%20loc=nav">To-Do</a>
                <a class="mdl-navigation__link" href="./Anleitungen/index.php?redir=/about.php%20loc=nav">Anleitungen</a>
                <a class="mdl-navigation__link" href="./history/index.php?redir=/about.php%20loc=nav">Abmelden&nbsp;🚪</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <div>
                    <h1 class="header">Was&nbsp;gibt's&nbsp;Neues?</h1>
                    <center><h3 class="version" style="width: 135px; color: white; font-weight: bold;border: 2px solid black; border-radius: 20px; background-color: darkslategrey;">&nbsp;<small><small>Version</small></small>&nbsp;<script src="./src/js/mt-portal_version.js"></script>&nbsp;</h3><pre style="color: #9ea4c9;">Größe:&nbsp;106&nbsp;MB<br>Client:&nbsp;32,6&nbsp;MB</pre></center>
                    <div class="changes">
                        <fieldset class="function">
                            <legend>Neue Funktionen:</legend>
			                <div class="li">
            				    <center>
                                    <script src="./src/js/mt-portal_changes-newFunction.js"></script>
			            	    </center>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="bugfix">
                            <legend>Bug-Fixes:<legend>
				            <div class="li">
					            <center>
                                    <script src="./src/js/mt-portal_changes-bugFix.js"></script>
					            </center>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>