<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">

    <div class="sidebar">
        <h2>Enrollment Management System</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="report.php">Reports</a>
        <a href="index.php">Logout</a>
    </div>

    <div class="main">
        <h1>Report Generator</h1>

        <button onclick="generate()">Generate Report</button>

        <div id="output"></div>
    </div>

</div>

<script>
function generate(){
    document.getElementById("output").innerHTML =
    "<p>Sample Report Generated (Students, Payments, etc.)</p>";
}
</script>

</body>
</html>