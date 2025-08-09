<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../login.php?redir=/history/HistoryLog.php%20noAuth");
        exit;
}
?>
<!DOCTYPE html>
<html lang="de-De">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../src/img/mtLogo.png">
    <title>Verlauf</title>
</head>

<body>
    <table style="border-collapse: collapse; width: 100%;" border="1">
        <tbody>


            <tr>
                <td>Benutzername</td>
                <td>Datum</td>
                <td>Erledigte Aufgabe
            </tr>



            <!--$LOG[HistoryLogged]-->
            <tr>
                <td>admin</td>
                <td>YYYY-MM-DD</td>
                <td>Task$RELOAD</td>
            </tr>

