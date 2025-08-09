<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../login.php");
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
    <link rel="icon" type="image/x-icon" href="../src/img/mtLogo.png">
    <link rel="stylesheet" href="../src/css/style-settings.css">
    <script src="./src/mdl/script-mdl.js"></script>
    <title>Einstellungen</title>
</head>

<body style="background-color: #c6cceb;">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
mdl-layout--fixed-tabs">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title"><a class="MTHead" href="../index.php">Medientutoren</a> -
                    <b>Einstellungen</b></span>
            </div>
            <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Benutzerverwaltung</a>
                <a href="#fixed-tab-2" class="mdl-layout__tab">Aufgabenplanung</a>
                <a href="#fixed-tab-3" class="mdl-layout__tab">Automatisierung</a>
                <a href="#fixed-tab-4" class="mdl-layout__tab">Systemeinstellungen</a>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Menü</span>
        </div>
        <main class="mdl-layout__content">
            <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
                <div class="page-content">
                    <div>
                        <h1>Benutzerverwaltung</h1>
                        <h3>Aktive Benutzer</h3>
                        <center>
                            <div>
                                <input type="checkbox" id="user1" checked>
                                <label for="user1">ferdinand.wicht</label>
                            </div>
                            <br>
                            <div>
                                <input type="checkbox" id="user2" checked>
                                <label for="user2">martin.blieninger</label>
                            </div>
                            <br>
                            <div>
                                <input type="checkbox" id="user3" checked>
                                <label for="user3">mia.wittmann</label>
                            </div>
                            <br>
                            <div>
                                <input type="checkbox" id="user4" checked>
                                <label for="user4">pascal.ruehlicke</label>
                            </div>
                            <br>
                            <div>
                                <input type="checkbox" id="user5" checked>
                                <label for="user5">svenja.fleder</label>
                            </div>
                            <br>
                            <div>
                                <input type="checkbox" id="user6" checked>
                                <label for="user6">tim.gehlert</label>
                            </div>
                            <br>
                        </center>
                        <h3>Inaktive Benutzer</h3>
                        <center>
                            <div>
                                <input type="checkbox" id="user0" unchecked>
                                <label for="user0">admin</label>
                            </div>
                        </center>
                    </div>
                </div>
            </section>
            <section class="mdl-layout__tab-panel" id="fixed-tab-2">
                <div class="page-content">
                    <div>
                        <h1>Aufgabenplanung</h1>
                        <h3>CronTab</h3>
                        <center>
                            <div>
                                <input type="checkbox" id="cron" unchecked>
                                <label for="cron">CronTab Kalendar</label>
                            </div>
                        </center>
                    </div>
                </div>
            </section>
            <section class="mdl-layout__tab-panel" id="fixed-tab-3">
                <div class="page-content">
                    <div>
                        <h1>Automatisierung</h1>
                        <h3>Nicht Verfügbar</h3>
                    </div>
                </div>
            </section>
            <section class="mdl-layout__tab-panel" id="fixed-tab-4">
                <div class="page-content">
                    <div>
                        <h1>Systemeinstellungen</h1>
                        <h3>Sicherheit</h3>
                        <center>
                            <div>
                                <input type="checkbox" id="2fa" unchecked>
                                <label for="2fa">2 Faktor Authentifikation</label>
                            </div>
                        </center>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
