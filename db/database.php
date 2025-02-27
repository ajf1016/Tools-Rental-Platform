<?php
$servername = "localhost";
$username = "root"; // Change if you have a different MySQL user
$password = ""; // Leave empty if using XAMPP default
$dbname = "tools_rental"; // Make sure this matches your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to utf8 for proper encoding
mysqli_set_charset($conn, "utf8");

?>
