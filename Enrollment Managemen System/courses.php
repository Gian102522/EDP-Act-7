<?php

session_start();

require_once "config/Database.php";

$db = new Database();

/* FETCH COURSES */

$query = "SELECT * FROM courses";

$result = $db->conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title>Courses</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>Courses</h2>

        <a href="dashboard.php">Dashboard</a>

        <a href="students.php">Students</a>

        <a href="courses.php">Courses</a>

        <a href="enrollments.php">Enrollments</a>

        <a href="payments.php">Payments</a>

        <a href="auth/logout.php">Logout</a>

    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <h1>Available Courses</h1>

        <div class="course-container">

            <?php while($row = $result->fetch_assoc()){ ?>

            <div class="course-card">

                <h2>
                    <?php echo $row['course_name']; ?>
                </h2>

                <p>
                    <strong>Course ID:</strong>
                    <?php echo $row['course_id']; ?>
                </p>

                <p>
                    This course is available for enrollment.
                </p>

                <a href="#" class="enroll-btn">
                    Enroll
                </a>

            </div>

            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>