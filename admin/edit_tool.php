<?php
session_start();
include '../db/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM tools WHERE id='$id'";
$result = mysqli_query($conn, $query);
$tool = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $rent_price = $_POST["rent_price"];

    $query = "UPDATE tools SET name='$name', description='$description', rent_price='$rent_price' WHERE id='$id'";
    mysqli_query($conn, $query);

    echo "<script>alert('Tool Updated Successfully'); window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tool</title>
</head>
<body>

<?php include '../includes/admin_navbar.php'; ?>

<div class="container mt-5">
    <h2>Edit Tool</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label class="form-label">Tool Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $tool['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required><?php echo $tool['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Rent Price ($)</label>
            <input type="number" name="rent_price" class="form-control" value="<?php echo $tool['rent_price']; ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Tool</button>
    </form>
</div>

</body>
</html>
