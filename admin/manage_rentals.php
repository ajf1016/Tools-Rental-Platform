<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

// Approve Rental
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    mysqli_query($conn, "UPDATE rentals SET status='approved' WHERE id='$id'");
    echo "<script>alert('Rental Approved'); window.location='manage_rentals.php';</script>";
}

// Decline Rental
if (isset($_GET['decline'])) {
    $id = $_GET['decline'];
    mysqli_query($conn, "UPDATE rentals SET status='declined' WHERE id='$id'");
    echo "<script>alert('Rental Declined'); window.location='manage_rentals.php';</script>";
}

// Mark as Returned
if (isset($_GET['returned'])) {
    $id = $_GET['returned'];
    mysqli_query($conn, "UPDATE rentals SET status='returned', return_date=NOW() WHERE id='$id'");
    echo "<script>alert('Tool Marked as Returned'); window.location='manage_rentals.php';</script>";
}

// Fetch Rentals
$rentals = mysqli_query($conn, "
    SELECT rentals.*, users.name AS customer_name, tools.name AS tool_name 
    FROM rentals 
    JOIN users ON rentals.user_id = users.id 
    JOIN tools ON rentals.tool_id = tools.id
    ORDER BY rentals.status DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Rentals</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2>Manage Rentals</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Tool</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rental = mysqli_fetch_assoc($rentals)) { ?>
                <tr>
                    <td><?php echo $rental['customer_name']; ?></td>
                    <td><?php echo $rental['tool_name']; ?></td>
                    <td><?php echo $rental['rent_date']; ?></td>
                    <td><?php echo $rental['return_date'] ? $rental['return_date'] : 'N/A'; ?></td>
                    <td>
                        <span class="badge bg-<?php 
                            echo $rental['status'] == 'pending' ? 'warning' :
                            ($rental['status'] == 'approved' ? 'success' : 
                            ($rental['status'] == 'returned' ? 'info' : 'danger')); ?>">
                            <?php echo ucfirst($rental['status']); ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($rental['status'] == 'pending') { ?>
                            <a href="?approve=<?php echo $rental['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="?decline=<?php echo $rental['id']; ?>" class="btn btn-danger btn-sm">Decline</a>
                        <?php } elseif ($rental['status'] == 'approved') { ?>
                            <a href="?returned=<?php echo $rental['id']; ?>" class="btn btn-info btn-sm">Mark as Returned</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
