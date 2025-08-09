<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../login.php?redir=/history/index.php%20noAuth");
        exit;
}
?>
<!DOCTYPE html>
<html lang="de-De">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style-startMenuIndex.css">
    <link rel="stylesheet" href="../src/mdl/style-mdl.css">
    <link rel="stylesheet" href="../src/mdl/style-googleAPI.css">
    <script src="./src/mdl/script-mdl.js"></script>
    <link rel="icon" type="image/x-icon" href="../src/img/mtLogo.png">
    <title>Verlauf</title>
</head>

<body style="background-color: #c6cceb;">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title"><a href="../index.php?redir=/history/index.php"
                        style="color: white; text-decoration: none;"><b>Medientutoren</b></a> - Was ich heute gemacht
                    habe..</span>
                <div class="mdl-layout-spacer"></div>
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link" href="../logout.php?redir=/history/index.php">Ohne Verlauf-Speicherung Abmelden&nbsp;🚪</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Menü</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="../index.php?redir=/history/index.php">HOME</a>
                <a class="mdl-navigation__link" href="../RaumCheck/index.php?redir=/history/index.php">Raum-Check</a>
                <a class="mdl-navigation__link" href="../ToDo/index.php?redir=/history/index.php">To-Do's</a>
		<a class="mdl-navigation__link" href="../Anleitungen/index.php?redir=/history/index.php">Anleitungen</a>
		<a class="mdl-navigation__link" href="../logout.php?redir=/history/index.php">Direkt Abmelden&nbsp;🚪</a>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	        <p>&emsp;&emsp;&emsp;&emsp;<a style="text-decoration: none; color: lightslategrey;" href="../about.php?redir=/history/index.php"><script src="./src/js/version.js"></script></a></p>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content" style="padding-top: 35px;">
                <form action="save.php" method="POST">
                    <center>
                        <span style="display: inline-block;"></span><input type="text" name="task" required="required"
                            placeholder="Was hab ich gemacht?"></input><br>
                        <span style="display: inline-block;"></span><input type="text" name="date" required="required"
                            placeholder="Datum YYYY-MM-DD"></input><br>
                        <span style="display: inline-block;"></span><input type="text" name="username"
                            required="required" placeholder="Benutzername"></input><br>
                        <span style="display: inline-block;"></span><input type="submit" value="In Verlauf Speichern"
                           ></input>
                    </center>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
