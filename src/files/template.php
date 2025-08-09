<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../../login.php");
        exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <link rel="stylesheet" href="../css/style-anleitungspgs.css">
  <link rel="icon" type="image/x-icon" href="../img/mtLogo.png">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <title>To-Do's</title>
</head>

<body style="background-color: #c6cceb;">
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title"><a class="backBtn" href="../../index.php">Medientutoren Portal</a> - <a class="backBtn" href="../../Anleitungen/index.php"><b>Anleitung</b></a></span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <a class="mdl-navigation__link" href="../../history/index.php">Abmelden&nbsp;<a class="logout"
                            href="../../logout.php">🚪</a>
        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Menü</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="../../index.php">HOME</a>
        <a class="mdl-navigation__link" href="../../RaumCheck/index.php">Raum-Check</a>
        <a class="mdl-navigation__link" href="../../ToDo/index.php">To-Do Liste</a>
        <a class="mdl-navigation__link" href="../../Anleitungen/index.php">Anleitungen</a>
        <a class="mdl-navigation__link" href="../../history/index.php">Abmelden&nbsp;🚪</a>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a style="text-decoration: none; color: lightslategrey;" href="../../about.php">MT-Portal 5.0</a></p>
      </nav>
    </div>
    <main class="mdl-layout__content">
      <div class="page-content">
      <br><br>
        <div class="container">
	  <center>
	    <div style="height: 500px; width: 800px; border: 2px solid black; border-radius: 20px;">
		<img src="./file.png"></img>
	    </div>	    
          </center>
        </div>
    </main>
  </div>

  </form>
</body>

</html>
