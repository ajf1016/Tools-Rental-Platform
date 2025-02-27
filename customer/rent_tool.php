<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "customer") {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $tool_id = $_GET['id'];
    $user_id = $_SESSION["user_id"];

    $query = "INSERT INTO rentals (user_id, tool_id) VALUES ('$user_id', '$tool_id')";
    mysqli_query($conn, $query);

    echo "<script>alert('Rental Request Sent!'); window.location='rental_history.php';</script>";
}
?>
