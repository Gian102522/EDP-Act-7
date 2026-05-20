<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-container">
    <div class="card">
        <h2>Login</h2>

        <!-- LOGIN FORM -->
        <form action="auth/login.php" method="POST">

            <input 
                type="text" 
                name="username" 
                placeholder="Username" 
                required
            >

            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required
            >

            <button type="submit">Login</button>

        </form>

        <a href="forgot.php">Forgot Password?</a>

    </div>
</div>

</body>
</html>