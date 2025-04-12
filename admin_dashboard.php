<?php 
// Start the session to access session variables
session_start();

// Include the configuration file, which typically contains database connection settings
include 'config.php';

// Check if the user is an admin. If not, redirect them to the login page
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Redirects to login page
    exit(); // Stops further script execution
}

// Fetch the last 4 goods sent from the database
$result = mysqli_query($conn, "SELECT * FROM sent_goods ORDER BY id DESC LIMIT 4");
// Store the results in an associative array for easier access
$last_goods = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design settings -->
    <title>Admin Dashboard - Emzor's Goods Outward Register</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file for styling -->
</head>
<body>
    <div class="dashboard-container">
        <!-- Welcomes the admin user by showing their username -->
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <div class="dashboard-buttons">
            <!-- Links to different functionalities available to the admin -->
            <a href="register_goods.php">Register Goods</a>
            <a href="view_goods.php">View Goods</a>
            <a href="logout.php">Logout</a>
            <a href="view_goods.php" class="delete-button">Delete Goods</a>
        </div>

        <h3>Last 4 Goods Sent</h3>
        <?php if (count($last_goods) > 0): ?> <!-- Check if there are any goods sent -->
            <table>
                <thead>
                    <tr>
                        <!-- Table headings for the goods information -->
                        <th>Date</th>
                        <th>Sender's Name</th>
                        <th>Receiver's Name</th>
                        <th>Total Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($last_goods as $goods): ?> <!-- Loop through each good item -->
                        <tr>
                            <!-- Display the details of each good in a table row -->
                            <td><?php echo $goods['date']; ?></td>
                            <td><?php echo $goods['sender_name']; ?></td>
                            <td><?php echo $goods['receiver_name']; ?></td>
                            <td><?php echo $goods['total_quantity']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Message displayed if no goods have been sent yet -->
            <p>No goods have been sent yet.</p>
        <?php endif; ?>
        
        <footer>
            <!-- Footer message with copyright information -->
            <p>ICT Intern Project by Gerard Uzodinma | &copy; 2024</p>
        </footer>
    </div>
</body>
</html>
