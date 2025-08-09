<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php?redir=/getLogout.php%20noAuth");
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
    <script src="./src/mdl/script-mdl.js"></script>
    <meta HTTP-EQUIV="REFRESH" content="5.5; url=logout.php?redir=/getLogout.php%20autoLogout">
    <title>LOGOUT</title>
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">Medientutoren - ABMELDUNG</span>
                <div class="mdl-layout-spacer"></div>
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title"></span>
            <nav class="mdl-navigation">
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <h1 style="text-align: center;">Du wirst in <b>5 Sekunden</b> <u>abgemeldet!</u></h1>
		<h3 style="text-align: center;"><a style="color: red;" href="index.php?redir=/getLogout.php%20cancel"><b>ABBRECHEN</b></a></h3>
            </div>
        </main>
    </div>
</body>

</html>
