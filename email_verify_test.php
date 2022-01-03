<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$sid = $_SERVER['SID'];
$token = $_SERVER['TOKEN'];
$serviceid = $_SERVER['SERVICEID'];

use Twilio\Rest\Client;

$twilio = new Client($sid, $token);

$verification = $twilio->verify->v2->services($serviceid)
    ->verifications
    ->create("nasirhafeez2002@gmail.com", "email");

?>