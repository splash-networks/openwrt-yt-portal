<?php
session_start();
?>
<head>
     <title>Login with Facebook</title>
     <link
        href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        rel = "stylesheet">
  </head>
  <body>     
  <?php if($_SESSION['fb_id']) {?>
        <div class = "container">
           <div class = "jumbotron">
              <h1>Hello <?php echo $_SESSION['fb_name']; ?></h1>
              <p>Welcome to Cloudways</p>
           </div>
              <ul class = "nav nav-list">
                 <h4>Image</h4>
                 <li><?php echo $_SESSION['fb_pic']?></li>
                 <h4>Facebook ID</h4>
                 <li><?php echo  $_SESSION['fb_id']; ?></li>
                 <h4>Facebook fullname</h4>
                 <li><?php echo $_SESSION['fb_name']; ?></li>
                 <h4>Facebook Email</h4>
                 <li><?php echo $_SESSION['fb_email']; ?></li>
              </ul>
          </div>
<?php } ?>
  </body>
</html>