<?php
session_start();

include 'parameters.php';

$mac = $_SESSION["mac"];
$ip = $_SESSION["ip"];
$linkorig = "https://portal.astiisb.com/thankyou.htm";
$linkloginonly = $_SESSION["linkloginonly"];
$method = $_SESSION["method"];
$phone = $_SESSION['phone'];

$last_updated = date("Y-m-d H:i:s");

$username="admin";
/*
Collecting the data entered by users of type "new" or "repeat_old" in form. It will be posted to the DB.
For "repeat_recent" type users no change will be made in the DB, they'll be authorized directly
*/

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$host_ip = $_SERVER['HOST_IP'];
$db_user = $_SERVER['DB_USER'];
$db_pass = $_SERVER['DB_PASS'];
$db_name = $_SERVER['DB_NAME'];

$con=mysqli_connect($host_ip,$db_user,$db_pass,$db_name);

if (mysqli_connect_errno()) {
        echo "Failed to connect to SQL: " . mysqli_connect_error();
}

if($_SESSION["user_type"]=="new" && $_SESSION["method"]=="Form"){

  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];

  mysqli_query($con, "
  CREATE TABLE IF NOT EXISTS `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `phone` varchar(45) NOT NULL,
    `firstname` varchar(45) NOT NULL,
    `lastname` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `mac` varchar(45) NOT NULL,
    `method` varchar(45) NOT NULL,
    `last_updated` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
  )");

  mysqli_query($con,"INSERT INTO `$table_name` (phone, firstname, lastname, email, mac, method, last_updated) VALUES ('$phone', '$fname', '$lname', '$email', '$mac', '$method', '$last_updated')");

}
elseif($_SESSION["user_type"]=="new" && $_SESSION["method"]=="Facebook"){

  $fname=$_SESSION['fname'];
  $lname=$_SESSION['lname'];
  $email=$_SESSION['email'];

  mysqli_query($con, "
  CREATE TABLE IF NOT EXISTS `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `phone` varchar(45) NOT NULL,
    `firstname` varchar(45) NOT NULL,
    `lastname` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `mac` varchar(45) NOT NULL,
    `method` varchar(45) NOT NULL,
    `last_updated` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
  )");

  mysqli_query($con,"INSERT INTO `$table_name` (phone, firstname, lastname, email, mac, method, last_updated) VALUES ('$phone', '$fname', '$lname', '$email', '$mac', '$method', '$last_updated')");

}
else {
  $fname=$_SESSION['fname'];
  $lname=$_SESSION['lname'];
  $email=$_SESSION['email'];

  mysqli_query($con,"INSERT INTO `$table_name` (phone, firstname, lastname, email, mac, method, last_updated) VALUES ('$phone', '$fname', '$lname', '$email', '$mac', '$method', '$last_updated')");
}

mysqli_close($con);

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Astiisb WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="bulma.min.css" />
  <script defer src="fontawesome-free-5.3.1-web\js\all.js"></script>
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css" />  
</head>
<body>
	<div class="bg">

    <figure id="logo">
      <img src="logo.png">
    </figure>

		<div id="handle" class="content is-size-6">Please wait, you are being </div>
		<div id="devices" class="content is-size-6">authorized on WiFi</div>

    <div id="powered_handle" class="content is-size-6">Powered by Astiisb</div>
    <div id="copyright" class="content is-size-6">(C) Copyright 2020</div>

  </div>

  <script type="text/javascript" src="./md5.js"></script>
        <script type="text/javascript">
                        function doLogin() {
                                        <?php if(strlen($chapid) < 1) echo "return true;\n"; ?>
                                        document.sendin.username.value = document.login.username.value;
                                        document.sendin.password.value = hexMD5('\011\373\054\364\002\233\266\263\270\373\173\323\234\313\365\337\356');
                                        document.sendin.submit();
                                        return false;
                        }
        </script>
        <script type="text/javascript">
                function formAutoSubmit () {
                        var frm = document.getElementById("login");
                        document.getElementById("login").submit();
                        frm.submit();
        }
        window.onload = formAutoSubmit;
        </script>

        <form id="login" method="post" action="<?php echo $linkloginonly; ?>" onSubmit="return doLogin()">
        <input name="dst" type="hidden" value="<?php echo $linkorig; ?>" />
        <input name="popup" type="hidden" value="false" />
        <input name="username" type="hidden" value="<?php echo $username; ?>"/>
        <input name="password" type="hidden"/>
        </form>

</body>
</html>