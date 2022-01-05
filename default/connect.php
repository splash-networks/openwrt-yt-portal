<?php
session_start();

include '../parameters.php';

$mac = $_SESSION["id"];
$apmac = $_SESSION["ap"];
$method = $_SESSION["method"];
$name = $_SESSION['name'];

if ($method == 'sms') {
    $phone = $_SESSION['address'];
    $email = "N/A";
} else {
    $phone = "N/A";
    $email = $_SESSION['address'];
}

$last_updated = date("Y-m-d H:i:s");

require '../vendor/autoload.php';

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

$con = mysqli_connect($host_ip, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
  echo "Failed to connect to SQL: " . mysqli_connect_error();
}

mysqli_query($con, "
CREATE TABLE IF NOT EXISTS `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `phone` varchar(16) NOT NULL,
    `email` varchar(45) NOT NULL,
    `name` varchar(100) NOT NULL,
    `mac` varchar(17) NOT NULL,
    `apmac` varchar(17) NOT NULL,
    `method` varchar(10) NOT NULL,
    `last_updated` datetime NOT NULL,
    PRIMARY KEY (`id`)
)");

if ($_SESSION['user_type'] == "new") {
    mysqli_query($con, "INSERT INTO `$table_name` (phone, email, name, mac, apmac, method, last_updated) VALUES ('$phone','$email','$name','$mac', '$apmac', '$method', '$last_updated')");
} else {
    mysqli_query($con, "UPDATE `$table_name` SET last_updated = '$last_updated' WHERE mac = '$mac'");
}

mysqli_close($con);

?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($business_name); ?> WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="refresh" content="5;url=thankyou.php" />
  <link rel="stylesheet" href="../assets/styles/bulma.min.css" />
  <link rel="stylesheet" href="..\vendor\fortawesome\font-awesome\css\all.css" />
  <link rel="icon" type="image/png" href="..\assets\images\favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="..\assets\images\favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="../assets/styles/style.css" />
</head>

<body>
  <div class="page">

    <div class="head">
      <br>
      <figure id="logo">
        <img src="../assets/images/logo.png">
      </figure>
    </div>

    <div class="main">
      <seection class="section">
        <div id="margin_zero" class="content has-text-centered is-size-6">Please wait, you are being </div>
        <div id="margin_zero" class="content has-text-centered is-size-6">authorized on WiFi</div>
      </seection>
    </div>

  </div>

</body>

</html>