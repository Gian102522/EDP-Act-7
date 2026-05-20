<?php

require_once "config/Database.php";

$db = new Database();

if(isset($_POST['register'])){

    $student_name = $_POST['student_name'];

    $email = $_POST['email'];

    $query = "
        INSERT INTO students
        (student_name, email)

        VALUES
        ('$student_name', '$email')
    ";

    if($db->conn->query($query)){

        echo "
            <script>

                alert('Student Registered Successfully');

                window.location.href='students.php';

            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Register Student</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="dashboard">

    <div class="sidebar">

        <h2>My System</h2>

        <a href="dashboard.php">Dashboard</a>

        <a href="students.php">Students</a>

        <a href="courses.php">Courses</a>

        <a href="payments.php">Payments</a>

    </div>

    <div class="main">

        <div class="card">

            <h2>Register Student</h2>

            <form method="POST">

                <input
                    type="text"
                    name="student_name"
                    placeholder="Student Name"
                    required
                >

                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                >

                <button name="register">
                    Register Student
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>