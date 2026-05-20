<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-container">

    <div class="card">

        <h2>Add Account</h2>

        <form action="users/add.php" method="POST">

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="email" name="email" placeholder="Email" required>

            <button type="submit">
                Add User
            </button>

        </form>

    </div>

</div>

</body>
</html>