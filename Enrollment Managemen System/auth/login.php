<?php
session_start();
require_once "../config/Database.php";

$db = new Database();

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM users 
          WHERE username='$username' 
          AND password='$password' 
          AND status='active'";

$result = $db->conn->query($query);

if($result->num_rows > 0){
    $_SESSION['user'] = $username;
    header("Location: ../dashboard.php");
} else {
    echo "Invalid credentials or inactive account";
}
?>