<?php

require_once "../config/Database.php";

$db = new Database();

$username = $_POST['username'];

$password = md5($_POST['password']);

$email = $_POST['email'];

$query = "
    INSERT INTO users(username,password,email)
    VALUES('$username','$password','$email')
";

if($db->conn->query($query)){

    echo "
        <script>

            alert('User added successfully!');

            window.location.href='../user_management.php';

        </script>
    ";

} else {

    echo "
        <script>

            alert('Failed to add user!');

            window.history.back();

        </script>
    ";

}
?>