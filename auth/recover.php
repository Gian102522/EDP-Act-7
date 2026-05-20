<?php
require_once "../config/Database.php";

$db = new Database();

$email = $_POST['email'];

$query = "SELECT * FROM users WHERE email='$email'";
$result = $db->conn->query($query);

if($result->num_rows > 0){
    echo "Password reset link sent (simulated)";
} else {
    echo "Email not found";
}
?>