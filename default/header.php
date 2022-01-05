<?php

session_start();

require '../vendor/autoload.php';
include '../parameters.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

