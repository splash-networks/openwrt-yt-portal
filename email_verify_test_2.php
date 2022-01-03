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
    ->create("134270", // code
        ["to" => "nasirhafeez2002@gmail.com"]
    );

echo $verification_check->status;

?>