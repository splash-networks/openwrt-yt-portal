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
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="bg">

    <figure id="logo">
      <img src="logo.png">
    </figure>

    <div id="login" class="content is-size-4 has-text-weight-bold">Login for Free Wi-Fi</div>

    <form id="login_success" class="form_login" method="post" action="connect.php">
      <br>
      
      <div class="field">
        <div class="control has-icons-left">
          <input class="input" type="text" id="form_font" name="fname" placeholder="First Name" required>
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
        </div>
      </div>
      
      <div class="field">
        <div class="control has-icons-left">
          <input class="input" type="text" id="form_font" name="lname" placeholder="Last Name" required>
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
        </div>
      </div>
      
      <div class="field">
        <div class="control has-icons-left">
          <input class="input" type="email" id="form_font" name="email" placeholder="Email" required>
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
        </div>
      </div>
      
      <div id="access_wifi" class="control">
        <button id="button_font" class="button is-danger">Continue</button>
      </div>
                        
    </form>

    <div id="logintext" class="content is-size-6">Or login using:</div>
    
    <div id="social">
      <a href="<?php echo htmlspecialchars($loginUrl);?>" class="facebookBtn smGlobalBtn"></a>
    </div>
    <br>

    <div id="powered_mikrotik" class="content is-size-6">Powered by Astiisb</div>
    <div id="copyright" class="content is-size-6">(C) Copyright 2020</div>

  </div>

</body>
</html>