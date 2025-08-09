<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../login.php?redir=/history/save.php%20noAuth");
        exit;
}
?>
<?php
session_start();
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
        foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                echo '<center><span style="color:DodgerBlue;text-weight:bold;">',$msg,'</span></center>';
        }
        unset($_SESSION['ERRMSG_ARR']);
}
?>
<?php
session_start();
$errmsg_arr = array();
$errflag = false;
$task  		= trim($_REQUEST["task"]);
$date		= trim($_REQUEST["date"]);
$username	= trim($_REQUEST["username"]);
$amp		= "";
$filename       = "HistoryLog.php";
$MyFile         = fopen($filename, "a");
$newline='	    <!--$LOG[HistoryLogged]-->
	    <tr>
	        <td>'.$username.'</td>
	        <td>'.$date.'</td>
	        <td>'.$task.'</td>
	    </tr>'.$amp."\r\n \n";

fwrite($MyFile, $newline);
fclose($MyFile);
$errmsg_arr[] = 'Verlauf gespeichert';
$errflag = true;
if($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("location: ../getLogout.php");
        exit();
}
die;
?>
