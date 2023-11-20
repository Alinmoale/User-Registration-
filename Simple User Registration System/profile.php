<?php
  require_once 'includes/config_session.inc.php';
  require_once 'includes/login_view.inc.php';  
  require_once 'includes/userupdate_view.inc.php';
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profile.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
  <title>Simple User Registration System</title>
</head>
<body>
  <div class="header">
    <h3>
     <?php
  output_username();
  ?>
</h3>
<form action="includes/logout.inc.php" method="post">
  <button class="logout_btn">Logout</button>
</form>
</div>
<div class="profile">
  <?php
  output_user_info();
  ?>
</div>

<div class="container">
<p class="title">Change account details</p>

<form action="includes/userupdate.inc.php" method="post" class="upd-form">
      <div class="form-control">
        <label for="username">New Username</label>
        <input type="text" name="username"id="username" placeholder="New Username">
        <small>Error message</small>
      </div>
      <div class="form-control " >
        <label for="email">New Email</label>
        <input type="text" name="email"id="email" placeholder="New E-Mail">
        <small>Error message</small>
      </div>
      <div class="form-control" >
        <label for="password">New Password</label>
        <input type="password" name="pwd"id="password" placeholder="New Password">
        <small>Error message</small>
      </div>
      <div class="form-control " >
          <label for="password2">Confirm Password </label>
          <input type="password"name="pwd2" id="password2" placeholder="Confirm Password">
          <small>Error message</small>       
      </div>
      <div class="form-control old" >
          <label for="old_pwd">Old Password </label>
          <input type="password"name="old_pwd" id="password2" placeholder="Old Password">
               
      </div>
      <?php
    check_update_errors();
    ?>
      <div class="update">
        <button class="update_btn">Update</button>
      </div>
    </form>
    
  </div>
    <div class="footer">

      <p class="delete_title">Delete account</p>
      
      <form id="deleteForm" action="includes/userdelete.inc.php" method="post">
        <button class="delete_btn" type="button" onclick="confirmDelete()">Delete Account</button>
      </form>
    </div>
    <script>
    function confirmDelete() {
        var result = confirm("Are you sure you want to delete your account?");
        if (result) {
            document.getElementById("deleteForm").submit();
        } else {
        }
    }
</script>
    
    <script src="script.js"></script>
</body>
</html>