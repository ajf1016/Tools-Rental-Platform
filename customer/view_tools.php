<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "customer") {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch available tools
$tools = mysqli_query($conn, "SELECT * FROM tools");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Tools</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include '../includes/customer_navbar.php'; ?>

<div class="container mt-5">
    <h2>Available Tools for Rent</h2>
    <div class="row">
        <?php while ($tool = mysqli_fetch_assoc($tools)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                <img src="../assets/images/<?php echo $tool['image']; ?>" class="card-img-top" alt="<?php echo $tool['name']; ?>" style="width: 250px; height: 250px; object-fit: contain; margin: 0 auto;">
                    <div class="card-body" style="margin-top : 20px;">
                        <h5 class="card-title"><?php echo $tool['name']; ?></h5>
                        <p class="card-text"><?php echo $tool['description']; ?></p>
                        <p class="fw-bold">Rent: $<?php echo $tool['rent_price']; ?>/day</p>
                        <a href="rent_tool.php?id=<?php echo $tool['id']; ?>" class="btn btn-primary">Rent Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
