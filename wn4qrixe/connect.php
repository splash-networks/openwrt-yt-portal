<?php

require 'header.php';
include 'config.php';

$mac = $_SESSION["id"];
$apmac = $_SESSION["ap"];
$method = $_SESSION["method"];

if ($method == "new") {
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $phone = $_SESSION['phone'];
  $email = $_SESSION['email'];

  $postData = [
    "mac" => $mac,
    "apmac" => $apmac,
    "venue_id" => $venue_id,
    "fname" => $fname,
    "lname" => $lname,
    "email" => $email,
    "phone" => $phone,
    "method" => $method
  ];
} else {
  $postData = [
    "mac" => $mac,
    "apmac" => $apmac,
    "venue_id" => $venue_id,
    "method" => $method
  ];
}

//$last_updated = date("Y-m-d H:i:s");

$controlleruser = $_SERVER['CONTROLLER_USER'];
$controllerpassword = $_SERVER['CONTROLLER_PASSWORD'];
$controllerurl = $_SERVER['CONTROLLER_URL'];
$controllerversion = $_SERVER['CONTROLLER_VERSION'];
$duration = $_SERVER['DURATION'];

$debug = false;

$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();

$auth_result = $unifi_connection->authorize_guest($mac, $duration, null, null, null, $apmac);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $api_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postData),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

if ($response !== false) {
  $json = json_decode($response, true);
  print_r($json);
}
else {
  die("Error: check with your network administrator");
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="../assets/styles/bulma.min.css" />
    <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css" />
    <meta http-equiv="refresh" content="5;url=https://www.google.com" />
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-16x16.png" sizes="16x16" />
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
            <div id="margin_zero" class="content has-text-centered is-size-6">Thanks, you are now </div>
            <div id="margin_zero" class="content has-text-centered is-size-6">authorized on WiFi</div>
        </seection>
    </div>

</div>
</body>
</html>