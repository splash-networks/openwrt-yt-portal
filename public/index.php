<?php

require 'header.php';
include 'config.php';

$res = $_GET["res"];

$_SESSION["mac"] = $_GET["mac"];
$_SESSION["challenge"] = $_GET["challenge"];
$_SESSION["uamip"] = $_GET["uamip"];
$_SESSION["uamport"] = $_GET["uamport"];
$_SESSION["userurl"] = $_GET["userurl"];
$_SESSION["user_type"] = "new";

# Checking DB to see if user exists or not.

mysqli_report(MYSQLI_REPORT_OFF);
$result = mysqli_query($con, "SELECT * FROM `$table_name` WHERE mac='$_SESSION[mac]'");

if ($result->num_rows >= 1) {
  $row = mysqli_fetch_array($result);

  mysqli_close($con);

  $_SESSION["user_type"] = "repeat";
  header("Location: welcome.php");
} else {
  mysqli_close($con);
}

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
      <?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="assets/styles/bulma.min.css"/>
    <link rel="stylesheet" href="vendor/fortawesome/font-awesome/css/all.css"/>
    <link rel="icon" type="image/png" href="assets/images/favicomatic/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="assets/images/favicomatic/favicon-16x16.png" sizes="16x16"/>
    <link rel="stylesheet" href="assets/styles/style.css"/>
</head>

<body>
<?php
    if ($res === "notyet") {
?>
<div class="page">

    <div class="head">
        <br>
        <figure id="logo">
            <img src="assets/images/logo.png">
        </figure>
    </div>

    <div class="main">
        <section class="section">
            <div class="container">
                <div id="contact_form" class="content is-size-5 has-text-centered has-text-weight-bold">Enter your details
                </div>
                <form method="post" action="connect.php">
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
                    <br>
                    <div class="columns is-centered is-mobile">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" required>
                                I agree to the <a href="policy.php">Terms of Use</a>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="buttons is-centered">
                        <button class="button is-link">Connect</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<?php
    } else if ($res === "success") {
      header("Location: $redirect_url");
    } else if ($res === "failed") {
      echo "<h2>Sorry, failed to authenticate</h2>";
    } else if ($res === "logoff") {
      echo "<h2>Logging off...</h2>";
    } else if ($res === "already") {
      header("Location: $redirect_url");
    } else {
      echo "<h2>Error: Permission Denied</h2>";
    }
?>
</body>
</html>