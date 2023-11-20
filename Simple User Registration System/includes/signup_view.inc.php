<?php

declare(strict_types=1);

function check_signup_errors() {
  if (isset( $_SESSION["error_signup"])) {
    $errors =  $_SESSION["error_signup"];


    foreach($errors as $error){
      echo '<p class="phperror">' .$error. '</p>';
    }

    unset( $_SESSION["error_signup"]);
  } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
    
      echo '<p class="form-success">Signup success!</p>';
    
  }
}