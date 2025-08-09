<?php session_start();

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php?redir=/logout.php%20noAuth");
        exit;
}
?>
<?php session_start();
session_destroy();
m_sleep(1200);

function m_sleep($milliseconds) {
  return usleep($milliseconds * 1000);
}
exec("bash ./plugins/logout.sh");
header("location:login.php?redir=/logout.php;action=userLogout");
exit;
?>
<script src="./src/js/mt-portal_logout.js"></script>