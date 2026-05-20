<?php
require_once "../config/Database.php";

$db = new Database();

$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM users 
          WHERE username LIKE '%$search%'";

$result = $db->conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title>User List</title>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="../style.css">

</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>My System</h2>

        <a href="../dashboard.php">Dashboard</a>

        <a href="../user_management.php">
            User Management
        </a>

        <a href="../auth/logout.php">Logout</a>

    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>User List</h1>

        <!-- SEARCH -->
        <form method="GET">

            <input 
                type="text"
                name="search"
                placeholder="Search username..."
            >

            <button type="submit">
                Search
            </button>

        </form>

        <br>

        <!-- TABLE -->
        <div class="table-container">

            <table>

                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>

                <?php while($row = $result->fetch_assoc()){ ?>

                <tr>

                    <td><?= $row['user_id']; ?></td>

                    <td><?= $row['username']; ?></td>

                    <td><?= $row['email']; ?></td>

                    <td><?= $row['status']; ?></td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>