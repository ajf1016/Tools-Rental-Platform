<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $rent_price = $_POST["rent_price"];
    $image = $_FILES["image"]["name"];
    $target = "../assets/images/" . basename($image);

    move_uploaded_file($_FILES["image"]["tmp_name"], $target);

    $query = "INSERT INTO tools (name, description, rent_price, image) VALUES ('$name', '$description', '$rent_price', '$image')";
    mysqli_query($conn, $query);

    echo "<script>alert('Tool Added Successfully'); window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include '../includes/admin_navbar.php'; ?>

<div class="container mt-5">
    <h2>Add Tool</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tool Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Rent Price ($)</label>
            <input type="number" name="rent_price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Tool</button>
    </form>
</div>

</body>
</html>
