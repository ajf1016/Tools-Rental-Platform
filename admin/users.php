<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

$users = mysqli_query($conn, "SELECT * FROM users WHERE role='customer'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2>Manage Users</h2>
    <ul>
        <?php while ($user = mysqli_fetch_assoc($users)) {
            echo "<li>{$user['name']} - {$user['email']}</li>";
        } ?>
    </ul>
</div>

</body>
</html>
