<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:../login.php?redir=/ToDo/save.php%20noAuth");
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
$task  = trim($_REQUEST["task"]);
$filename       = "toDoList.json";
$MyFile         = fopen($filename, "a");
$newline='To-Do: '.$task."\r\n \n";
fwrite($MyFile, $newline);
fclose($MyFile);
$errmsg_arr[] = 'Deine Aufgabe wurde in die To-Do Liste gespeichert';
$errflag = true;
if($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("location: index.php?redir=/ToDo/save.php;action=save%20phpPOST:$task%20in%20phpFN:$filename");
        exit();
}
die;
?>
<html>
<body>
<script>
        let uuid = crypto.randomUUID();
        localStorage.setItem("mtUser_session=" + (uuid), "com.mt-portal.mtsw_application");
        localStorage.setItem("session_cookie=" + (uuid), (uuid));
        localStorage.setItem("debug_information=" + (uuid), "mt-portal.localstorage_pageFileINF=/ToDo/save.php");
        var x = localStorage.getItem("content");
</script>
</body>
</html>
