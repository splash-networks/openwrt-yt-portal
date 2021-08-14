<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($business_name);?> WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="bulma.min.css" />
  <script defer src="vendor\fortawesome\font-awesome\js\all.js"></script>
  <meta http-equiv="refresh" content="5;url=index.php" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
	<div class="bg">

  <section class="hero is-small">
      <div class="hero-body">
        <figure id="logo">
          <img src="logo.png">
        </figure>
      </div>
    </section>

    <section class="section">

		<div id="result" class="content is-size-6">Sorry! The code you entered</div>
		<div id="devices" class="content is-size-6">is not correct. You'll shortly be</div>
		<div id="devices" class="content is-size-6">redirected back to our main page</div>

    </section>

    <footer class="footer">
      <div id="powered" class="content has-text-centered is-size-6">Powered by <?php echo htmlspecialchars($business_name);?></div>
      <div id="copyright" class="content has-text-centered is-size-6">(C) Copyright <?php echo htmlspecialchars($current_year);?></div>
    </footer>

	</div>
</body>
</html>