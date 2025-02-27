<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tools WHERE id='$id'");

echo "<script>alert('Tool Deleted Successfully'); window.location='dashboard.php';</script>";
?>
