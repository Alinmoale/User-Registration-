<?php
require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $old_username = $_SESSION["user_username"];
        $old_email = $_SESSION["user_email"];

        $username = $_POST["username"];
        $pwd = $_POST["pwd"];
        $pwd2 = $_POST["pwd2"];
        $email = $_POST["email"];
        $old_pwd = $_POST["old_pwd"]; 

        try {
            require_once 'dbh.inc.php';
            require_once 'userupdate_model.inc.php';
            require_once 'userupdate_contr.inc.php';

            $errors = [];

           
            if (empty($old_pwd) || !is_old_password_correct($pdo, $user_id, $old_pwd)) {
                $errors["old_pwd_incorrect"] = "Old password is incorrect!";
            } else {
                
                if (!empty($email) && is_email_invalid($email)) {
                    $errors["invalid_email"] = "Invalid email used!";
                }

                
                if (!empty($username) && is_username_taken($pdo, $username)) {
                    $errors["username_taken"] = "Username already taken!";
                }

                
                if (!empty($email) && is_email_registered($pdo, $email)) {
                    $errors["email_used"] = "Email already registered!";
                }

                
                if (!empty($pwd)) {
                    
                    if (empty($pwd2)) {
                        $errors["pwd2_empty"] = "Confirm Password cannot be empty!";
                    } else {
                        if (is_not_password_ok($pdo, $pwd)) {
                            $errors["pwd_notStrong"] = "Password should be at least 8 characters in length and should include at least one upper case letter!";
                        }

                        
                        if ($pwd !== $pwd2) {
                            $errors["pwd_match"] = "Password does not match!";
                        }
                    }
                }

                
                if (empty($errors)) {
                    
                    $updateFields = [];
                    $queryParams = [];
                    

                    if (!empty($username)) {
                        $updateFields[] = "username = :username";
                        $queryParams[":username"] = $username;
                    }

                    if (!empty($email)) {
                        $updateFields[] = "email = :email";
                        $queryParams[":email"] = $email;
                    }

                    if (!empty($pwd)) {
                        $updateFields[] = "pwd = :pwd";
                        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]);
                        $queryParams[":pwd"] = $hashedPwd;
                    }

                   
                    if (!empty($updateFields)) {
                        $query = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = :user_id;";
                        $stmt = $pdo->prepare($query);

                        
                        $stmt->bindParam(":user_id", $user_id);
                        foreach ($queryParams as $param => $value) {
                            $stmt->bindParam($param, $value);
                        }

                        $stmt->execute();
                    }

                    
                    if (!empty($username)) {
                        $_SESSION["user_username"] = $username;
                    }
                    if (!empty($email)) {
                      $_SESSION["user_email"] = $email;
                  }

                   
                    header("location: ../profile.php");
                    die();
                }
            }

            
            if (!empty($errors)) {
                $_SESSION["error_update"] = $errors;
                header("Location: ../profile.php");
                die();
            }

           

        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    } else {
        
        header("Location: ../login.php");
        die();
    }
} else {
    
    header("Location: ../index.php");
    die();
}
?>
