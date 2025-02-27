<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch all tools
$tools = mysqli_query($conn, "SELECT * FROM tools");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Tools</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include '../includes/admin_navbar.php'; ?>

<div class="container mt-5">
    <h2>Manage Tools</h2>
    <a href="add_tool.php" class="btn btn-primary mb-3">Add New Tool</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tool Name</th>
                <th>Description</th>
                <th>Rent Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($tool = mysqli_fetch_assoc($tools)) { ?>
                <tr>
                    <td><?php echo $tool['name']; ?></td>
                    <td><?php echo $tool['description']; ?></td>
                    <td>$<?php echo $tool['rent_price']; ?>/day</td>
                    <td>
                        <a href="edit_tool.php?id=<?php echo $tool['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_tool.php?id=<?php echo $tool['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
