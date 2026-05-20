<?php

require_once "config/Database.php";

$db = new Database();

/* TOTAL STUDENTS */

$students = $db->conn->query(
    "SELECT COUNT(*) AS total FROM students"
);

$totalStudents = $students->fetch_assoc()['total'];

/* TOTAL COURSES */

$courses = $db->conn->query(
    "SELECT COUNT(*) AS total FROM courses"
);

$totalCourses = $courses->fetch_assoc()['total'];

/* TOTAL PAYMENTS */

$payments = $db->conn->query(
    "SELECT COUNT(*) AS total FROM payments"
);

$totalPayments = $payments->fetch_assoc()['total'];

/* TOTAL ENROLLMENTS */

$enrollments = $db->conn->query(
    "SELECT COUNT(*) AS total FROM enrollments"
);

$totalEnrollments = $enrollments->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">

    <div class="sidebar">
        <h2><img src="logo2.png" alt="Logo" width="200"></h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="students.php">Students</a>
        <a href="courses.php">Courses</a>
        <a href="enrollments.php">Enrollments</a>
        <a href="payments.php">Payments</a>
        <a href="report.php">Reports</a>
        <a href="about.php">About</a>
        <a href="user_management.php">User Management</a>
        <a href="auth/logout.php">Logout</a>
    </div>

    <div class="main">
        <h1>Dashboard</h1>

        <div class="card-box">
            <h2><?php echo $totalStudents; ?></h2>
            <p>Total Students</p>
        </div>

        <div class="card-box">
            <h2><?php echo $totalCourses; ?></h2>
            <p>Total Courses</p>
        </div>

        <div class="card-box">
            <h2><?php echo $totalPayments; ?></h2>
            <p>Total Payments</p>
        </div>

        <div class="card-box">
            <h2><?php echo $totalEnrollments; ?></h2>
            <p>Total Enrollments</p>
        </div>

    </div>

</div>

</body>
</html>