<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "customer") {
    header("Location: ../auth/login.php");
    exit();
}
?>
