<?php

require_once "../config/Database.php";

$db = new Database();

$id = $_POST['id'];

$email = $_POST['email'];

$query = "
    UPDATE users
    SET email='$email'
    WHERE user_id=$id
";

if($db->conn->query($query)){

    echo "
        <script>

            alert('User updated successfully!');

            window.location.href='../user_management.php';

        </script>
    ";

} else {

    echo "
        <script>

            alert('Update failed!');

            window.history.back();

        </script>
    ";

}
?>