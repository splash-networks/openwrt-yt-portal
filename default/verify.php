<?php

require 'header.php';

$_SESSION['name'] = $_POST['name'];

if (isset($_POST['phone_number'])) {
    $phone = $_POST['country_code'] . $_POST['phone_number'];
    $_SESSION['address'] = trim($phone);
}
if (isset($_POST['email'])) {
    $_SESSION['address'] = $_POST['email'];
    $_SESSION['method'] = "email";
}

$sid = $_SERVER['SID'];
$token = $_SERVER['TOKEN'];
$serviceid = $_SERVER['SERVICEID'];

use Twilio\Rest\Client;

$twilio = new Client($sid, $token);

$verification = $twilio->verify->v2->services($serviceid)
    ->verifications
    ->create($_SESSION['address'], $_SESSION['method']);

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($business_name); ?> WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="../assets/styles/bulma.min.css" />
  <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css" />
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
        <form method="post" action="result.php" onsubmit="return codeCheck()">
          <div id="margin_zero" class="content has-text-centered is-size-6">Please enter the 6 digit code</div>
          <div id="margin_zero" class="content has-text-centered is-size-6">received on your provided address</div>
          <div id="gap" class="content is-size-6"></div>
          <div class="field">
            <div class="control has-icons-left">
              <input class="input" type="number" name="code" id="code" placeholder="Code" required>
              <span class="icon is-small is-left">
                <i class="fas fa-comment"></i>
              </span>
            </div>
          </div>
          <p class="help is-warning" id="codeError">Code Invalid: not a 6 digit number</p>
          <div class="buttons is-centered">
            <button id="button_font" class="button is-link">Verify</button>
          </div>
        </form>
      </seection>
    </div>

  </div>

  <script>
    function codeCheck() {
      var codeInput = document.getElementById('code').value;

      //The SMS code has to be a 6 digit number. Checking for that:

      if (codeInput.length != 6 || isNaN(codeInput)) {
        document.getElementById("codeError").style.display = "block";
        return false;
      } else {
        return true;
      }
    }
  </script>
</body>

</html>