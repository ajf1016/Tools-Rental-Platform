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
    
    // Handle Image Upload
    $image = $_FILES["image"]["name"];
    $target_dir = "../assets/images/";
    $target_file = $target_dir . basename($image);

    // Check if file is uploaded successfully
    if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        echo "<script>alert('File Upload Error: " . $_FILES["image"]["error"] . "');</script>";
    }

    // Check if directory exists
    if (!file_exists($target_dir)) {
        echo "<script>alert('Error: Upload directory does not exist.');</script>";
    }

    // Move file to target location
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Store only the image name in the database
        $query = "INSERT INTO tools (name, description, rent_price, image) 
                  VALUES ('$name', '$description', '$rent_price', '$image')";
        mysqli_query($conn, $query);

        echo "<script>alert('Tool Added Successfully'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error moving uploaded file.');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<?php include '../includes/admin_navbar.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="text-center">Add New Tool</h4>
                </div>
                <div class="card-body">
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

                        <button type="submit" class="btn btn-success w-100">Add Tool</button>
                        <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
