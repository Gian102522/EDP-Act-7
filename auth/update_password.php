<?php

require_once "../config/Database.php";

$db = new Database();

$email = $_POST['email'];

$password = md5($_POST['password']);

$query = "
    UPDATE users 
    SET password='$password'
    WHERE email='$email'
";

if($db->conn->query($query)){

    echo "
        <script>
            alert('Password updated successfully!');
            window.location.href='../index.php';
        </script>
    ";

} else {

    echo "Error updating password.";

}
?>