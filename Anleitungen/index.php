<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../login.php?redir=/Anleitungen/index.php%20noAuth");
        exit;
}
?>
<?php
  exec("sudo bash syncGuide.sh");
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
    <link rel="stylesheet" href="../src/css/style-anleitungen.css">
    <link rel="icon" type="image/x-icon" href="../src/img/mtLogo.jpg">
    <title>Anleitungen</title>
</head>

<body style="background-color: #c6cceb;">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title"><a class="backBtn" href="../index.php?redir=/Anleitungen/index.php">Medientutoren Portal</a>&nbsp;-&nbsp;<b>Anleitungen</b></span>
                    <div class="mdl-layout-spacer"></div>
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link" href="../history/index.php?redir=/Anleitungen/index.php%20loc=bar">Abmelden&nbsp;<a class="logout" href="../logout.php?redir=/Anleitungen/index.php%20loc=bar">🚪</a>
                    </nav>
                </div>
                </header>
                <div class="mdl-layout__drawer">
                        <span class="mdl-layout-title">Menü</span>
                        <nav class="mdl-navigation">
                                <a class="mdl-navigation__link" href="../index.php?redir=/Anleitungen/index.php%20loc=nav">HOME</a>
                                <a class="mdl-navigation__link" href="../RaumCheck/index.php?redir=/Anleitungen/index.php%20loc=nav">Raum-Check</a>
                                <a class="mdl-navigation__link" href="../ToDo/index.php?redir=/Anleitungen/index.php%20loc=nav">To-Do Liste</a>
                                <a class="mdl-navigation__link" href="#">Anleitungen</a>
                                <a class="mdl-navigation__link" href="../history/index.php?redir=/Anleitungen/index.php%20loc=nav">Abmelden&nbsp;🚪</a>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			        <p>&emsp;&emsp;&emsp;&emsp;<a style="text-decoration: none; color: lightslategrey;" href="../about.php?redir=/Anleitungen/index.php"><script src="../src/js/version.js"></script></a></p>
                        </nav>
                </div>
                <main class="mdl-layout__content">
                        <div class="page-content">
				<br>
        				<div class="msg">
          					<div class="alert" style="border: 2px solid #45254f; border-radius: 20px;">
            						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
							<strong>Neu hier?&nbsp;</strong>Du kannst dir hier Anleitungen ansehen, um Aufgaben leichter erledigen zu können (z.B. iPad-MDM Einbindung).
						</div>
					</div>
     				<br>
                                <div style="padding-top: 25px; padding-left: 80px; padding-right: 80px;"
                                        class="anleitungen">
                                        <div style="display: flex; justify-content: space-between;">
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                        </div>
                                        <br>
                                        <div class="hidden" style="display: flex; justify-content: space-between;">
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <!-- <img class="PDFimg" src="../src/img/icon_pdf.jpg"> -->
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                        </div>
                                        <br>
                                        <div class="hidden" style="display: flex; justify-content: space-between;">
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                                <div style="height: 120px; width: 180px; border: 2px solid black; border-radius: 20px; background-color: #2a3657;">
                                                        <a class="underLine" href="#">
                                                                <img class="PDFimg" src="../src/img/icon_pdf.jpg">
                                                                <br>&emsp;&emsp;&emsp;&emsp;&emsp;Anleitung
                                                                </img>
                                                        </a>
                                                </div>
                                                <br>
                                        </div>
                                </div>
                </main>
        </div>
</body>

</html>
