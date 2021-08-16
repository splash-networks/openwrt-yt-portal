<?php
session_start();

include 'parameters.php';
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$fb = new Facebook\Facebook([
  'app_id'                => $_SERVER['APP_ID'],
  'app_secret'            => $_SERVER['APP_SECRET'],
  'default_graph_version' => $_SERVER['DEFAULT_GRAPH_VERSION'],
]);

$helper      = $fb->getRedirectLoginHelper();
$scope       = array("email");
$loginUrl    = $helper->getLoginUrl($callBackUrl,$scope);

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Astiisb WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="bulma.min.css" />
  <link rel="stylesheet" href="font-awesome\css\font-awesome.min.css" />
  <script defer src="vendor\fortawesome\font-awesome\js\all.js"></script>
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="bg">

    <figure id="logo">
      <img src="logo.png">
    </figure>

    <div id="social">
      <a href="<?php echo htmlspecialchars($loginUrl);?>" class="facebookBtn smGlobalBtn"></a>
    </div>
    <br>


  </div>

</body>
</html>