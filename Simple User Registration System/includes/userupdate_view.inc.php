<?php

declare(strict_types=1);
 
require_once 'config_session.inc.php';

function output_username()
{
  if(isset($_SESSION["user_id"])) {
    echo "You are logged in as " . $_SESSION["user_username"];
  };
}

function output_user_info()
{
  if (isset($_SESSION["user_id"])) {
    if (isset($_SESSION["user_email"])) {
        echo "Email: " . $_SESSION["user_email"] . "<br>";
    }

    if (isset($_SESSION["user_username"])) {
        echo "Username: " . $_SESSION["user_username"];
    }
}
}

function check_update_errors() {
  if (isset( $_SESSION["error_update"])) {
    $errors =  $_SESSION["error_update"];


    foreach($errors as $error){
      echo '<p class="phperror">' .$error. '</p>';
    }

    unset( $_SESSION["error_update"]);
  }  else if (isset($_GET["update"]) && $_GET["update"] === "success") {
    
    echo '<p class="form-success">Update success!</p>';
  
}
}
if (isset($_SESSION["user_id"]) && !isset($_SESSION["user_email"])) {
  try {
      require_once 'dbh.inc.php'; 

      $user_id = $_SESSION["user_id"];

      $query = "SELECT email FROM users WHERE id = :user_id;";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(":user_id", $user_id);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result && isset($result['email'])) {
          $_SESSION["user_email"] = $result['email'];
      }
  } catch (PDOException $e) {
      die("Query failed: " . $e->getMessage());
  }
}
