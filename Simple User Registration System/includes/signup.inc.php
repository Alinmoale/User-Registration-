<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $pwd2 = $_POST["pwd2"];
  $email = $_POST["email"];
  
  try {
    
    require_once 'dbh.inc.php';
    require_once 'signup_model.inc.php';
    require_once 'signup_contr.inc.php';

    // ERROR HANDLERS
    $errors = [];

    if (is_input_empty($username, $pwd, $email)){
      $errors["empty_input"] = "Fill in all fields!";
    }
  

    if (is_email_invalid($email)){
      $errors["invalid_email"] = "Invalid email used!";
    }
    
    if (is_username_taken($pdo, $username)) {
      $errors["username_taken"] = "Username already taken!";
    }
    if (is_email_registered($pdo, $email)) {
      $errors["email_used"] = "Email already registered!";
    }
    if (is_not_password_ok($pdo, $pwd)) {
      $errors["pwd_notStrong"] = "Password should be at least 8 characters in length and should include at least one upper case letter!";
    }
    if (is_password_match($pdo, $pwd, $pwd2)) {
      $errors["pwd_match"] = "Password does not match!";
    }

    require_once 'config_session.inc.php';
    
    if ($errors) {
      $_SESSION["error_signup"] = $errors;
      header("Location: ../index.php");
      die();
    }

    create_user( $pdo,  $pwd, $username,  $email);

    header("Location: ../index.php?signup=success");

    $pdo = null;
    $stmt = null;
    die();


  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
}else {
  header("Location: ../index.php");
  die();
}