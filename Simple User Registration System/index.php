<?php
  require_once 'includes/config_session.inc.php';
  require_once 'includes/signup_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

  <title>Simple User Registration System</title>
</head>
<body>
  <div class="container">
    <div class="header">
      <h3>Create Account</h3>
    </div>

    <form action="includes/signup.inc.php" method="post" class="form" id="form"  >
      <div class="form-control">
          <label for="username">Username</label>
          <input type="text" name="username"id="username" placeholder="Username">
          <small>Error message</small>
      </div>
      <div class="form-control " >
          <label for="email">Email</label>
          <input type="text" name="email"id="email" placeholder="E-Mail">
          <small>Error message</small>
      </div>
      <div class="form-control" >
          <label for="password">Password</label>
          <input type="password" name="pwd"id="password" placeholder="Password">
          <small>Error message</small>
      </div>
      <div class="form-control passwordtwo" >
          <label for="password2">Confirm Password </label>
          <input type="password"name="pwd2" id="password2" placeholder="Confirm Password">
          <small>Error message</small>
         
      </div>
        <?php    
          check_signup_errors();
        ?>
        <button  class="signup">SIGN UP</button>
      </form>
    
      <div class="footer">
          <p>Already have an account?</p>
          <a href="login.php">
            <button class="login">login</button>

          </a>
      </div>
  </div>
  <script src="script.js"></script>
</body>
</html>