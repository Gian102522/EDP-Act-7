<?php

require_once "config/Database.php";

$db = new Database();

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE user_id=$id";

$result = $db->conn->query($query);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-container">

    <div class="card">

        <h2>Update Account</h2>

        <form action="users/update.php" method="POST">

            <input type="hidden" name="id" value="<?= $row['user_id']; ?>">

            <input 
                type="email" 
                name="email"
                value="<?= $row['email']; ?>"
                required
            >

            <button type="submit">
                Update
            </button>

        </form>

    </div>

</div>

</body>
</html>