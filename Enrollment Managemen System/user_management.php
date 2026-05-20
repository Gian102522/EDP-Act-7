<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

require_once "config/Database.php";

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
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>My System</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="user_management.php">User Management</a>
        <a href="auth/logout.php">Logout</a>

    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>User Management</h1>

        <!-- TOP BAR -->
        <div class="top-bar">

            <!-- SEARCH -->
            <form method="GET">

                <input 
                    type="text" 
                    name="search"
                    class="search-box"
                    placeholder="Search username..."
                >

                <button type="submit" class="btn-inline">
                    Search
                </button>

            </form>

            <!-- ADD USER -->
            <a href="add_user.php" class="add-btn">
                + Add Account
            </a>

        </div>

        <!-- TABLE -->
        <div class="table-container">

            <table>

                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php while($row = $result->fetch_assoc()){ ?>

                <tr>

                    <td><?= $row['user_id']; ?></td>

                    <td><?= $row['username']; ?></td>

                    <td><?= $row['email']; ?></td>

                    <td><?= $row['status']; ?></td>

                    <td>

                        <!-- UPDATE -->
                        <a 
                            href="update_user.php?id=<?= $row['user_id']; ?>" 
                            class="action-btn edit-btn"
                        >
                            Update
                        </a>

                        <!-- TOGGLE -->
                        <a 
                            href="users/toggle.php?id=<?= $row['user_id']; ?>&status=<?= $row['status']; ?>" 
                            class="action-btn toggle-btn"
                        >
                            Toggle
                        </a>

                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>