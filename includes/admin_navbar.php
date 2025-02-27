<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../admin/dashboard.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../admin/dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/add_tool.php">Add Tool</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/manage_rentals.php">Manage Rentals</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/tools_list.php">Manage Tools</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/users.php">Manage Users</a></li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white px-3" href="../auth/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
