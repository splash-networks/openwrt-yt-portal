<?php
session_start();

include 'parameters.php';

$mac=$_SESSION["id"];
$ap=$_SESSION["ap"];
$method = $_SESSION["method"];
$phone = $_SESSION['phone'];

$last_updated = date("Y-m-d H:i:s");

/*
Collecting the data entered by users of type "new" or "repeat_old" in form. It will be posted to the DB.
For "repeat_recent" type users no change will be made in the DB, they'll be authorized directly
*/

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$controlleruser = $_SERVER['CONTROLLER_USER'];
$controllerpassword = $_SERVER['CONTROLLER_PASSWORD'];
$controllerurl = $_SERVER['CONTROLLER_URL'];
$controllerversion = $_SERVER['CONTROLLER_VERSION'];
$duration = $_SERVER['DURATION'];

$debug = false;

$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();

$auth_result = $unifi_connection->authorize_guest($mac, $duration, null, null, null, $ap);

$host_ip = $_SERVER['HOST_IP'];
$db_user = $_SERVER['DB_USER'];
$db_pass = $_SERVER['DB_PASS'];
$db_name = $_SERVER['DB_NAME'];

$con=mysqli_connect($host_ip,$db_user,$db_pass,$db_name);

if (mysqli_connect_errno()) {
        echo "Failed to connect to SQL: " . mysqli_connect_error();
}

if($_SESSION["user_type"]=="new" && $_SESSION["method"]=="Form"){

  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];

  mysqli_query($con, "
  CREATE TABLE IF NOT EXISTS `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `phone` varchar(45) NOT NULL,
    `firstname` varchar(45) NOT NULL,
    `lastname` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `mac` varchar(45) NOT NULL,
    `method` varchar(45) NOT NULL,
    `last_updated` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
  )");

  mysqli_query($con,"INSERT INTO `$table_name` (phone, firstname, lastname, email, mac, method, last_updated) VALUES ('$phone', '$fname', '$lname', '$email', '$mac', '$method', '$last_updated')");

}
elseif($_SESSION["user_type"]=="new" && $_SESSION["method"]=="Facebook"){

  $fname=$_SESSION['fname'];
  $lname=$_SESSION['lname'];
  $email=$_SESSION['email'];

  mysqli_query($con, "
  CREATE TABLE IF NOT EXISTS `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `phone` varchar(45) NOT NULL,
    `firstname` varchar(45) NOT NULL,
    `lastname` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `mac` varchar(45) NOT NULL,
    `method` varchar(45) NOT NULL,
    `last_updated` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
  )");

  mysqli_query($con,"INSERT INTO `$table_name` (phone, firstname, lastname, email, mac, method, last_updated) VALUES ('$phone', '$fname', '$lname', '$email', '$mac', '$method', '$last_updated')");

}
else {
  $fname=$_SESSION['fname'];
  $lname=$_SESSION['lname'];
  $email=$_SESSION['email'];

  mysqli_query($con,"INSERT INTO `$table_name` (phone, firstname, lastname, email, mac, method, last_updated) VALUES ('$phone', '$fname', '$lname', '$email', '$mac', '$method', '$last_updated')");
}

mysqli_close($con);

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($business_name);?> WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="refresh" content="5;url=thankyou.php" />
  <link rel="stylesheet" href="bulma.min.css" />
  <script defer src="fontawesome-free-5.3.1-web\js\all.js"></script>
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css" />  
</head>
<body>
<div class="page">

<div class="head">
  <br>
  <figure id="logo">
    <img src="logo.png">
  </figure>
</div>

<div class="main">
      <seection class="section">

		<div id="margin_zero" class="content has-text-centered is-size-6">Please wait, you are being </div>
		<div id="margin_zero" class="content has-text-centered is-size-6">authorized on WiFi</div>

    </seection>
    </div>

    <div class="foot">
      <div id="margin_zero" class="content has-text-centered is-size-6">Powered by <?php echo htmlspecialchars($business_name);?></div>
      <div id="margin_zero" class="content has-text-centered is-size-6">(C) Copyright <?php echo htmlspecialchars($current_year);?></div>
      </div>
  </div>

</body>
</html>