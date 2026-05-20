<?php
require_once "../config/Database.php";

$db = new Database();

$id = $_GET['id'];
$status = $_GET['status'];

$newStatus = ($status == 'active') ? 'inactive' : 'active';

$query = "UPDATE users SET status='$newStatus' WHERE user_id=$id";

$db->conn->query($query);

header("Location: list.php");
?>