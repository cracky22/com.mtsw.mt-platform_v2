<!DOCTYPE html>
<html>

<head>
	<title>neuer Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./src/css/style-newacc.css">
	<link rel="icon" type="image/x-icon" href="./src/img/mtLogo.png">
	<meta charset="UTF-8">
</head>

<body>
	<h1>Neuer Account?</h1>
<?php session_start();
session_destroy();
m_sleep(2790);

function m_sleep($milliseconds) {
  return usleep($milliseconds * 1000);
}
?>
	<div>
		<p style="padding-left: 25px; padding-right: 25px;">Du bist neu bei den Medientutoren?
			Herzlich willkommen. Wir arbeiten digital, daher wirst du einen Medientutoren Account benötigen.
			Da du dir selbstverständlich nicht selbst einen eingenen Account anlegen kannst, schreibe mir bitte eine
			Email.</p>
		<p style="text-align: center; padding-top: 1px;">Das einzige was ich von dir brauche ist:</p>
		<center>
			<li style="font-size: 140%;">vorname</li>
			<li style="font-size: 140%;">nachname</li>
			<li style="font-size: 140%;">klasse</li>
		</center>
	</div>
	<br>
	<div style="margin: 0 auto;text-align:center;">
		<button style="font-size:120%;color:DarkSlateBlue;text-align:center;"
			onclick="window.location.href = 'mailto:martinblieninger2208@gmail.com?subject=Medientutoren Accountregistrierung&body=Es soll bitte ein neuer Account erstellt werden für:%0AVorname = %0ANachmane = %0AKlasse = ';">Mail
			für Registrierung schreiben</button>
	</div>
	<div style="clear:right;"></div>
	<br>
	<div style="float:right;">
		<button style="font-size:80%;color:steelblue;text-align:left;"
			onclick="window.location.href = './login.php?redir=newAcc.php';">zurück</button>
		<div style="clear:right;"></div>
</body>
</html>