<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Tools Rental</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Tools Rental</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="customer/view_tools.php">Browse Tools</a></li>
                <li class="nav-item"><a class="nav-link" href="auth/login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link btn btn-primary text-white px-3" href="auth/register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="hero-section text-center text-white d-flex align-items-center" style="background: url('assets/images/hero-bg.jpg') no-repeat center center/cover; height: 60vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Rent Industrial Tools Easily!</h1>
        <p class="lead">Browse a variety of high-quality tools at affordable rental prices.</p>
        <a href="customer/view_tools.php" class="btn btn-lg btn-primary mt-3">Browse Tools</a>
    </div>
</header>

<!-- Featured Tools Section -->
<section class="container my-5">
    <h2 class="text-center mb-4">Featured Tools</h2>
    <div class="row">
        <?php
        include 'db/database.php';
        $query = "SELECT * FROM tools ORDER BY RAND() LIMIT 3";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <img src="assets/images/'.$row['image'].'" class="card-img-top" alt="'.$row['name'].'">
                    <div class="card-body">
                        <h5 class="card-title">'.$row['name'].'</h5>
                        <p class="card-text">'.$row['description'].'</p>
                        <p class="fw-bold">Rent: $'.$row['rent_price'].'/day</p>
                        <a href="customer/rent_tool.php?id='.$row['id'].'" class="btn btn-primary">Rent Now</a>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</section>

<!-- Testimonials -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h2>What Our Customers Say</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p>"Great experience! The tools were in perfect condition and easy to rent."</p>
                    <footer class="blockquote-footer">John Doe</footer>
                </blockquote>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p>"Super affordable and convenient rental process. Highly recommended!"</p>
                    <footer class="blockquote-footer">Emily Smith</footer>
                </blockquote>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p>"Quick service and well-maintained tools. Will rent again!"</p>
                    <footer class="blockquote-footer">Michael Johnson</footer>
                </blockquote>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="container my-5">
    <h2 class="text-center">Contact Us</h2>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; <?php echo date("Y"); ?> Industrial Tools Rental. All rights reserved.</p>
</footer>

</body>
</html>
