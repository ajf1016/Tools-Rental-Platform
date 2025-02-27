<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "customer") {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$rentals = mysqli_query($conn, "
    SELECT rentals.*, tools.name AS tool_name, tools.rent_price, rentals.total_price
    FROM rentals 
    JOIN tools ON rentals.tool_id = tools.id
    WHERE rentals.user_id = '$user_id'
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include '../includes/customer_navbar.php'; ?>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION["user_name"]; ?>!</h2>
    <p><a href="view_tools.php" class="btn btn-primary">Browse Available Tools</a></p>

    <h3 class="mt-4">My Rentals</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tool</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rental = mysqli_fetch_assoc($rentals)) { ?>
                <tr>
                    <td><?php echo $rental['tool_name']; ?></td>
                    <td><?php echo $rental['rent_date']; ?></td>
                    <td><?php echo $rental['return_date'] ? $rental['return_date'] : 'N/A'; ?></td>
                    <td><?php echo ($rental['status'] == 'returned') ? "$" . $rental['total_price'] : "N/A"; ?></td>
                    <td>
                        <span class="badge bg-<?php 
                            echo $rental['status'] == 'pending' ? 'warning' :
                            ($rental['status'] == 'approved' ? 'success' : 
                            ($rental['status'] == 'returned' ? 'info' : 'danger')); ?>">
                            <?php echo ucfirst($rental['status']); ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
