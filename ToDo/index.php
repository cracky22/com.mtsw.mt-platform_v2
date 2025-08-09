<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../login.php?redir=/ToDo/index.php%20noAuth");
        exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../src/css/style-startMenuIndex.css">
  <link rel="stylesheet" href="../src/mdl/style-mdl.css">
  <link rel="stylesheet" href="../src/mdl/style-googleAPI.css">
  <link rel="stylesheet" href="../src/css/style-todo.css">
  <script src="./src/mdl/script-mdl.js"></script>
  <link rel="icon" type="image/x-icon" href="../src/img/mtLogo.png">
  <title>To-Do's</title>
</head>

<?php
session_start();
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
        foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                echo '<center><span style="color: DodgerBlue; text-weight: bold;">',$msg,'</span></center>';
        }
        unset($_SESSION['ERRMSG_ARR']);
}
?>

<body style="background-color: #c6cceb;">
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title"><a class="backBtn" href="../index.php?redir=/ToDo/index.php%20loc=bar">Medientutoren Portal</a> - <b>ToDo
            Liste</b></span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <a class="mdl-navigation__link" href="../history/index.php?redir=/ToDo/index.php%20loc=bar">Abmelden&nbsp;<a class="logout"
                            href="../logout.php?redir=/ToDo/index.php%20loc=bar">🚪</a>
        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Menü</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="../index.php?redir=/ToDo/index.php%20loc=nav">HOME</a>
        <a class="mdl-navigation__link" href="../RaumCheck/index.php?redir=/ToDo/index.php%20loc=nav">Raum-Check</a>
        <a class="mdl-navigation__link" href="#">To-Do Liste</a>
        <a class="mdl-navigation__link" href="../Anleitungen/index.php?redir=/ToDo/index.php%20loc=nav">Anleitungen</a>
        <a class="mdl-navigation__link" href="../history/index.php?redir=/ToDo/index.php%20loc=nav">Abmelden&nbsp;🚪</a>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p>&emsp;&emsp;&emsp;&emsp;<a style="text-decoration: none; color: lightslategrey;" href="../about.php?redir=/ToDo/index.php%20loc=nav"><script src="../src/js/mt-portal_version.js"></script></a></p>
      </nav>
    </div>
    <main class="mdl-layout__content">
      <div class="page-content">
	<br>
        <div class="msg">
          <div class="alert" style="border: 2px solid #274b61; border-radius: 20px;">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Neu hier?&nbsp;</strong>Du kannst dir hier Notizen in das Medientutoren-Portal (z.B. AppleTV-Fernbedienungen demnächst aufladen) speichern.
          </div>
        </div>
        <br>
        <form action="save.php" method="POST">
          <div class="container">
            <center>
              <span style="display: inline-block;"></span><input type="text" name="task" required="required"
                placeholder="Neue To-Do Aufgabe" />
              <span style="display: inline-block;"></span><input type="submit"
                value="In To-Do Liste Speichern" /><br><br>
              <embed style="border: 2.5px solid #3f51b5; border-radius: 20px;" type="text/plain" data="toDoList.json" src="toDoList.json"
                width="420" height="400"><br>
          </div><br>
          <center><input type="button" value="Liste Leeren"
              onclick="window.location.href='remove.php?cmd=bash+clearList.sh';" /></center>
          </center>


      </div>
    </main>
  </div>

  </form>
</body>

</html>
