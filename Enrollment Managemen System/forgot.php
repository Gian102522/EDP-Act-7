<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-container">

    <div class="card">

        <h2>Password Recovery</h2>

        <form action="auth/check_email.php" method="POST">

            <input 
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

            <button type="submit">
                Verify Email
            </button>

        </form>

        <a href="index.php">Back to Login</a>

    </div>

</div>

</body>
</html>