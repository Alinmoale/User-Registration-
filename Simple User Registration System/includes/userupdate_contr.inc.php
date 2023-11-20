<?php

declare(strict_types=1);

function is_email_invalid(string $email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
  } else {
    return false;
  }
}


function is_username_taken(object $pdo,string $username)
{
  if (get_username($pdo, $username)){
    return true;
  }else {
    return false;
  }
}

function is_email_registered(object $pdo,string $email)
{
  if (get_email($pdo , $email)){
    return true;
  }else {
    return false;
  }
}
function is_not_password_ok($pdo,string $pwd){
  $length = strlen($pwd);
  $uppercase = preg_match('@[A-Z]@', $pwd);
  if(!$uppercase || $length<8){
    return true;
  }else {
    return false;
  }
}
function is_password_match($pdo,string $pwd, string $pwd2){
  if($pwd !== $pwd2){
    return true;
  }else {
    return false;
  }
}
function is_old_password_correct($pdo, $user_id, $oldPwd)
{
    $query = "SELECT pwd FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return password_verify($oldPwd, $result["pwd"]);
    }

    return false;
}