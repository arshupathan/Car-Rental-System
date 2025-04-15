<?php
// Database configuration
$hostName = "localhost"; // Replace with your database host (usually localhost)
$dbUser = "root";        // Replace with your database username (WAMP default is root)
$dbPassword = "";        // Replace with your database password (WAMP default is empty)
$dbName = "user"; // Replace with your actual database name

// Create the database connection
$con = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check the connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
