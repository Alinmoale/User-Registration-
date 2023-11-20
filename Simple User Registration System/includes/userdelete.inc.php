<?php

require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];

        try {
            require_once 'dbh.inc.php';
            
            $query = "DELETE FROM users WHERE id = :user_id;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();

            
            session_unset();
            session_destroy();

            $pdo = null;
            $stmt = null;

           
            header("location: ../index.php");
            die();
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