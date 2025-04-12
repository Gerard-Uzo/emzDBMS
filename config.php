<?php
// Database connection settings
$servername = "localhost"; // The server hosting the database
$username = "root"; // The username to connect to the database
$password = ""; // The password for the database user
$dbname = "emzor_goods_outward_register"; // The name of the database to connect to

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    // If the connection failed, display an error message and stop the script
    die("Connection failed: " . mysqli_connect_error());
}
?>
