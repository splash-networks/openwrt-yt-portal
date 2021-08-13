<?php error_reporting(E_ALL ^ E_NOTICE); 
session_start();

/*
This page runs an API request to Twilio to verify the code provided by the user
*/

$_SESSION['code'] = trim($_POST['code']);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$sid = $_SERVER['SID'];
$token = $_SERVER['TOKEN'];
$serviceid = $_SERVER['SERVICEID'];

use Twilio\Rest\Client;

$twilio = new Client($sid, $token);

$verification_check = $twilio->verify->v2->services($serviceid)
                                         ->verificationChecks
                                         ->create($_SESSION['code'], // code
                                                  ["to" => $_SESSION['phone']]
                                         );

if ($verification_check->status == "approved") {
    header("Location: verify_pass.php");
}
else {
    header("Location: verify_fail.php");
}

?>