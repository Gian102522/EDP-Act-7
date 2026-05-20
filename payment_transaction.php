<?php

require_once "config/Database.php";

$db = new Database();

if(isset($_POST['pay'])){

    $student_name = $_POST['student_name'];

    $amount = $_POST['amount'];

    $query = "
        INSERT INTO payments
        (
            student_name,
            amount,
            payment_date
        )

        VALUES
        (
            '$student_name',
            '$amount',
            NOW()
        )
    ";

    if($db->conn->query($query)){

        echo "
            <script>

                alert('Payment Successful');

                window.location.href='payments.php';

            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Payment Transaction</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="center-container">

    <div class="card">

        <h2>Payment Transaction</h2>

        <form method="POST">

            <input
                type="text"
                name="student_name"
                placeholder="Student Name"
                required
            >

            <input
                type="number"
                name="amount"
                placeholder="Amount"
                required
            >

            <button name="pay">
                Submit Payment
            </button>

        </form>

    </div>

</div>

</body>
</html>