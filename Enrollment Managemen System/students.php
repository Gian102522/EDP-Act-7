<?php

session_start();

require_once "config/Database.php";

$db = new Database();

$result = $db->conn->query("SELECT * FROM students");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">

    <div class="sidebar">

        <h2>Students</h2>

        <a href="dashboard.php">Dashboard</a>

        <a href="students.php">Students</a>

        <a href="enrollments.php">Enrollments</a>

        <a href="payments.php">Payments</a>

        <a href="auth/logout.php">Logout</a>

    </div>

    <div class="main">
        <div class="report-header">
            <h1>Student Report</h1>
        </div>
        <div class="table-container">

            <table>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>

                <?php while($row = $result->fetch_assoc()){ ?>

                <tr>

                    <td><?= $row['student_id']; ?></td>

                    <td><?= $row['student_name']; ?></td>

                    <td><?= $row['email']; ?></td>

                    <td><?= $row['status']; ?></td>

                </tr>

                <?php } ?>

            </table>
            <a href="export_students.php" class="add-btn">
                Export to Excel
            </a>
<!--
            <br><br>

             <div style="margin-top:50px;">

                _______________________

            <br>

                System Administrator

            </div>
-->
        </div>

    </div>

</div>

</body>
</html>