<?php session_start();
	if(isset($_POST['Submit'])){
		$logins = array(
			'mt-dbrsp' => 'DBRSPSJ2023!',
      'mt-admin' => 'nzDZxdX0gMhqiacK',
      'admin' => 'cRgPCEWiGSWxVKm9';
      'martin.blieninger' => 'DBRSPSJ2023!',
      'pascal.ruehlicke' => 'DBRSPSJ2023!',
      'tim.gehlert' => 'DBRSPSJ2023!',
      'moritz.hierner' => 'DBRSPSJ2023!',
      'lennard.schilling' => 'DBRSPSJ2023!',
      'svenja.fleder' => 'DBRSPSJ2023!',
      'ferdinand.wicht' => 'DBRSPSJ2023!',
		);
		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			$_SESSION['UserData']['Username']=$logins[$Username];
			exec("bash ./plugins/login.sh");
			header("location:index.php?redir=login.php;login=true;usr=$Username;location=/com.mtsw.mt-platform/mt-portal/index.php");
			exit;
		} else {
			$msg="<span style='font-size: 140%;font-weight: bold;color: red;'><i>Ungültige</i> <u>Zugangsdaten</u><b>!</b></span>";
		}
	}
?>
<!DOCTYPE html>
<html lang="de-De">
<head>
  <meta charset="utf-8">
  <title>Medientutoren Portal</title>
  <link href="./src/css/style-login.css" rel="stylesheet">
  <link rel="stylesheet" href="./src/css/style-startMenuIndex.css">
  <link rel="stylesheet" href="./src/mdl/style-mdl.css">
  <link rel="stylesheet" href="./src/mdl/style-googleAPI.css">
  <script src="./src/mdl/script-mdl.js"></script>
  <link rel="icon" type="image/x-icon" href="./src/img/mtLogo.jpg">
</head>
<body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header" style="height: 110px;">
      <div class="mdl-layout__header-row">
      <img class="logo" src="./src/img/mtLogo.jpg"></img>
      <span class="mdl-layout-title">
        <h4 class="header"><br>Medientutoren Portal</h4>
      </span>
      </header>
        <main class="mdl-layout__content">
          <div class="page-content">
          <br>
          <form action="" method="post" name="Login_Form">
            <table width="360" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
              <?php if(isset($msg)){?>
                <tr>
                <td colspan="2" align="center" valign="top">
                  <?php echo $msg;?>
                </td>
                </tr>
              <?php } ?>
            <tr>
              <td colspan="2" align="left" valign="top">
                <h5><b>Login</b></h5>
              </td>
            </tr>
            <tr>
              <td align="right"><b>Benutzername:</b> </td>
              <td><input name="Username" type="text" class="Input" placeholder="Bitte Benutzername eingeben" required>
              </td>
            </tr>
            <tr>
              <td align="right"><b>Passwort:</b> </td>
              <td><input name="Password" type="password" class="Input" placeholder="Bitte Passwort eingeben" required>
              </td>
            </tr>
            <tr>
              <td>&nbsp;<a class="noAccBtn" href="./newAcc.php?redir=login.php;usrAct=accountless;">Keinen Account?</a></td>
              <td><input name="Submit" type="submit" value="Anmelden" class="Button3"></td>
            </tr>
          </table>
        </form>
      </div>
    </main>
  </div>
</body>
</html>