<?php
session_start();
include '../db/database.php';

// Ensure only Admin can access
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch statistics
$total_tools = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM tools"))['count'];
$total_rentals = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM rentals"))['count'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE role='customer'"))['count'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="../assets/css/styles.css" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        />
    </head>
    <body>
        <?php include '../includes/admin_navbar.php'; ?>

        <div class="container mt-5">
            <h2>Admin Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Tools</h5>
                            <p class="card-text"><?php echo $total_tools; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Rentals</h5>
                            <p class="card-text">
                                <?php echo $total_rentals; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text"><?php echo $total_users; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
