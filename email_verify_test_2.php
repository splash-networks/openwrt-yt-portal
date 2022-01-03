<?php

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
    ->create("574860", // code
        ["to" => "nhafeez3@gatech.edu"]
    );

echo $verification_check->status;

?>