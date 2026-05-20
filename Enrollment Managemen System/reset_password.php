<?php

$email = $_GET['email'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-container">

    <div class="card">

        <h2>Reset Password</h2>

        <form action="auth/update_password.php" method="POST">

            <input 
                type="hidden"
                name="email"
                value="<?= $email; ?>"
            >

            <input 
                type="password"
                name="password"
                placeholder="New Password"
                required
            >

            <button type="submit">
                Update Password
            </button>

        </form>

    </div>

</div>

</body>
</html>