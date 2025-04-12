<?php
// Start the session to access session variables
session_start();

// Include the configuration file for database connection
include 'config.php';

// Check if the user is an admin. If not, redirect them to the login page
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Redirects to the login page
    exit(); // Stops further script execution
}

// Check if an 'id' is provided in the URL (indicating which record to delete)
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the 'id' from the URL

    // Prepare the SQL statement to delete the record with the given ID
    $sql = "DELETE FROM sent_goods WHERE id = $id";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // If the deletion was successful, display a success message
        echo "Record deleted successfully";
    } else {
        // If there was an error, display the error message
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Redirect back to the view goods page after the operation
    header("Location: view_goods.php");
}
?>
