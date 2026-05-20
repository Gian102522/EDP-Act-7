<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

require_once "config/Database.php";

$db = new Database();

$result = $db->conn->query("SELECT * FROM enrollments");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Enrollments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">

    <div class="sidebar">
        <h2>Enrollments</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="students.php">Students</a>
        <a href="enrollments.php">Enrollments</a>
        <a href="payments.php">Payments</a>
        <a href="auth/logout.php">Logout</a>
    </div>

    <div class="main">

        <div class="report-header">
            <h1>Enrollment Report</h1>
        </div>

        <div class="table-container">

            <table>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Enrollment Date</th>
                </tr>

                <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?= $row['enrollment_id']; ?></td>
                    <td><?= $row['student_id']; ?></td>
                    <td><?= $row['student_name']; ?></td>
                    <td><?= $row['course_id']; ?></td>
                    <td><?= $row['course_name']; ?></td>
                    <td><?= $row['enrollment_date']; ?></td>
                </tr>
                <?php } ?>

            </table>
            <a href="export_enrollments.php" class="add-btn">
                Export to Excel
            </a>
        </div>
        
        <!--
        <br><br>

             <div style="margin-top:50px;">

                _______________________

            <br>

                Registrar

            </div>
-->
    </div>

</div>

</body>
</html>