<?php
// Pass session data over. Only needed if not already passed by another script like WordPress.
session_start();

// Include the required dependencies.
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$fb = new Facebook\Facebook([
    'app_id'                => $_SERVER['APP_ID'],
    'app_secret'            => $_SERVER['APP_SECRET'],
    'default_graph_version' => $_SERVER['DEFAULT_GRAPH_VERSION'],
  ]);

$helper = $fb->getRedirectLoginHelper();

$_SESSION['FBRLH_state']=$_GET['state'];

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
  echo "Logged in!". ".<br>";

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=email,name', $_SESSION['facebook_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

$_SESSION["email"]=$user['email'];
$_SESSION["method"]="Facebook";

$name=$user['name'];
$parts = explode(" ", $name);

$_SESSION["lname"] = array_pop($parts);
$_SESSION["fname"] = implode(" ", $parts);

header("Location: connect.php");