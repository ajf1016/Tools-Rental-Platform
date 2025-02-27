<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Tools Rental</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item"><a class="nav-link" href="../customer/dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white px-3" href="../auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="../auth/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white px-3" href="../auth/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
