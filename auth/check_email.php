<?php

require_once "../config/Database.php";

$db = new Database();

$email = $_POST['email'];

$query = "SELECT * FROM users WHERE email='$email'";

$result = $db->conn->query($query);

if($result->num_rows > 0){

    header("Location: ../reset_password.php?email=$email");

} else {

    echo "
        <script>
            alert('Email not found!');
            window.location.href='../forgot.php';
        </script>
    ";

}
?>