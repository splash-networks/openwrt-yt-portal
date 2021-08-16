<?php
session_start();

include 'parameters.php';
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($business_name); ?> WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="bulma.min.css" />
  <link rel="stylesheet" href="font-awesome\css\font-awesome.min.css" />
  <script defer src="vendor\fortawesome\font-awesome\js\all.js"></script>
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="page">

    <div class="head">
      <br>
      <figure id="logo">
        <img src="logo.png">
      </figure>
    </div>

    <div class="main">
      <seection class="section">
        <div id="login" class="content is-size-4 has-text-centered has-text-weight-bold">Login for Free Wi-Fi</div>
        <form method="post" action="connect.php">
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

          <div class="buttons is-centered">
            <button id="button_font" class="button is-danger">Continue</button>
          </div>
        </form>

        <br>
      </seection>
    </div>

    <div class="foot">
      <div id="margin_zero" class="content has-text-centered is-size-6">Powered by <?php echo htmlspecialchars($business_name); ?></div>
      <div id="margin_zero" class="content has-text-centered is-size-6">(C) Copyright <?php echo htmlspecialchars($current_year); ?></div>
    </div>
  </div>

</body>

</html>