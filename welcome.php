<?php error_reporting(E_ALL ^ E_NOTICE); 
session_start();

/*
Printing a welcome message for the user
*/

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Astiisb WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="bulma.min.css" />
  <script defer src="vendor\fortawesome\font-awesome\js\all.js"></script>
  <meta http-equiv="refresh" content="5;url=connect.php" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
	<div class="bg">

    <figure id="logo">
      <img src="logo.png">
    </figure>

		<div id="devices" class="content is-size-6">Welcome, <?php echo htmlspecialchars($_SESSION["fname"]);?>!</div>
		<div id="devices" class="content is-size-6">You'll be automatically authorized</div>
		<div id="devices" class="content is-size-6">on the network in a few moments</div>
    
    <div id="powered_welcome" class="content is-size-6">Powered by Astiisb</div>
    <div id="copyright" class="content is-size-6">(C) Copyright 2020</div>

	</div>
</body>
</html>
