<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

require_once "config/Database.php";

$db = new Database();

$result = $db->conn->query("SELECT * FROM payments");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">

    <div class="sidebar">
        <h2>Payments</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="students.php">Students</a>
        <a href="enrollments.php">Enrollments</a>
        <a href="payments.php">Payments</a>
        <a href="auth/logout.php">Logout</a>
    </div>

    <div class="main">

        <div class="report-header">
            <h1>Payment Report</h1>
        </div>
        <div class="table-container">

            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>

                <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?= $row['payment_id']; ?></td>
                    <td><?= $row['student_id']; ?></td>
                    <td><?= $row['student_name']; ?></td>
                    <td><?= $row['amount']; ?></td>
                    <td><?= $row['payment_date']; ?></td>
                </tr>
                <?php } ?>

            </table>
            <a href="export_payments.php" class="add-btn">
                Export to Excel
            </a>
        </div>

        <!--
        <br><br>

        _______________________<br>
        Cashier
-->
    </div>

</div>

</body>
</html>