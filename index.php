<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php?redir=/index.php%20noAuth");
        exit;
}

?>
<?php
  exec("bash ./plugins/selfCheck.sh");
?>

<!DOCTYPE html>
<html>
<head>
  <html lang="de-De">
  <meta charset="utf-8">
  <title>Medientutoren</title>
  <link rel="icon" type="image/x-icon" href="./src/img/mtLogo.jpg">
  <link rel="stylesheet" href="./src/css/style-index.css">
  <link rel="stylesheet" href="./src/css/style-startMenuIndex.css">
  <link rel="stylesheet" href="./src/mdl/style-mdl.css">
  <link rel="stylesheet" href="./src/mdl/style-googleAPI.css">
  <script src="./src/mdl/script-mdl.js"></script>
  <!--<meta http-equiv="refresh" content="80; URL=./autoLogout.php">-->
</head>
<body style="background-color: #c6cceb;">
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Medientutoren Portal&nbsp;-&nbsp;<b>Home</b></span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <a class="mdl-navigation__link" href="./history/index.php?redir=/index.php%20loc=bar">Abmelden&nbsp;
            <a class="logout" href="./logout.php?redir=/index.php%20loc=bar">🚪</a>
          </a>
        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Menü</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="./RaumCheck/index.php?redir=/index.php%20loc=nav">Raum-Check</a>
        <a class="mdl-navigation__link" href="./ToDo/index.php?redir=/index.php%20loc=nav">To-Do Liste</a>
        <a class="mdl-navigation__link" href="./Anleitungen/index.php?redir=/index.php%20loc=nav">Anleitungen</a>
        <a class="mdl-navigation__link" href="./history/index.php?redir=/index.php$20loc=nav">Abmelden&nbsp;🚪</a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p>&emsp;&emsp;&emsp;&emsp;<a class="version" href="./about.php"><script src="./src/js/mt-portal_version.js"></script></a></p>
      </nav>
    </div>
    <main class="mdl-layout__content">
      <div class="page-content">
	    <br>
	    <div class="msg">
	      <div class="alert" style="border: 2px solid darkred; border-radius: 20px;">
	        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	        <strong>Neue Nachricht:&nbsp;</strong>Hi und Willkommen auf dem Medientutoren Portal. <a class="msgTut" href="../techHelp/externalContent/com.mtsw.mt-portal/index.html?comeFrom=mt-portalIndex;">Tutorials</a>
	      </div>
	    </div>
      <br>
      <center>
      <div style="" class="actions"><br><br>
        <a class="raumCheckBtn" href="./RaumCheck/index.php?redir=/index.php">
          <img src="./src/img/raumcheck.jpg" class="image"></img>
        </a>
        &emsp;&emsp;&emsp;
        <a class="toDoBtn" href="./ToDo/index.php?redir=/index.php">
          <img src="./src/img/toDo.jpg" class="image"></img>
        </a>
        &emsp;&emsp;&emsp;
        <a class="anleitungenBtn" href="./Anleitungen/index.php?redir=/index.php">
          <img src="./src/img/anleitung.jpg" class="image"></img>
        </a>
        <p class="pictxtB">Raum-Check&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;To-Do&nbsp;Liste&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Anleitungen</p>
        <p class="pictxtS">Raum-Check&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;To-Do&nbsp;Liste&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Anleitungen</p>
        </div>
        <br><br>
        <div class="widgets">
          <h3 class="calendarHead"><a class="widgetBtn" href="./ToDo/index.php">ToDo</a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a class="widgetBtn" href="./ToDo/index.php">Raum-Status</a></h3>
          <embed src="./ToDo/toDoList.json" type="text/plain" data="toDoList.json" style="height: 170px; width: 340px;"></embed><embed src="./RaumCheck/roomList.php" type="text/plain" data="roomList.php" style="height: 170px; width: 520px;"></embed>
        </div>
	      </center>
	      <br>
      </div>
    </main>
  </div>
</body>
</html>