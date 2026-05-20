<?php

require_once "config/Database.php";

$db = new Database();

$course_id = $_GET['id'];

/* GET COURSE */

$courseQuery = "
    SELECT *
    FROM courses
    WHERE course_id='$course_id'
";

$courseResult = $db->conn->query($courseQuery);

$course = $courseResult->fetch_assoc();

/* REGISTER ENROLLMENT */

if(isset($_POST['enroll'])){

    $student_id = $_POST['student_id'];

    $student_name = $_POST['student_name'];

    $course_name = $course['course_name'];

    $query = "
        INSERT INTO enrollments
        (
            student_id,
            student_name,
            course_id,
            course_name,
            enrollment_date
        )

        VALUES
        (
            '$student_id',
            '$student_name',
            '$course_id',
            '$course_name',
            NOW()
        )
    ";

    if($db->conn->query($query)){

        echo "
            <script>

                alert('Enrollment Successful');

                window.location.href='enrollments.php';

            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Enroll Student</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="center-container">

    <div class="card">

        <h2>
            Enroll in
            <?php echo $course['course_name']; ?>
        </h2>

        <form method="POST">

            <input
                type="text"
                name="student_id"
                placeholder="Student ID"
                required
            >

            <input
                type="text"
                name="student_name"
                placeholder="Student Name"
                required
            >

            <button name="enroll">
                Confirm Enrollment
            </button>

        </form>

    </div>

</div>

</body>
</html>