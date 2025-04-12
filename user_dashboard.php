<?php
// Start the session to access session variables
session_start();

// Include the configuration file for database connection
include 'config.php';

// Check if the user is a regular user. If not, redirect them to the login page
if ($_SESSION['role'] != 'user') {
    header("Location: login.php"); // Redirects to the login page
    exit(); // Stops further script execution
}

// Fetch the last 4 goods sent from the database
$result = mysqli_query($conn, "SELECT * FROM sent_goods ORDER BY id DESC LIMIT 4");
$last_goods = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all results as an associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures responsive design -->
    <title>User Dashboard - Emzor's Goods Outward Register</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file for styling -->
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?> (User)</h2> <!-- Displays a welcome message with the user's name -->
        <div class="dashboard-buttons">
            <!-- Links for the user to navigate -->
            <a href="register_goods.php">Register Goods</a>
            <a href="view_goods.php">View Goods</a>
            <a href="logout.php">Logout</a>
        </div>

        <h3>Last 4 Goods Sent</h3>
        <?php if (count($last_goods) > 0): ?> <!-- Check if there are any goods sent -->
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Sender's Name</th>
                        <th>Receiver's Name</th>
                        <th>Total Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($last_goods as $goods): ?> <!-- Loop through the last goods to display each -->
                        <tr>
                            <td><?php echo $goods['date']; ?></td> <!-- Display the date -->
                            <td><?php echo $goods['sender_name']; ?></td> <!-- Display the sender's name -->
                            <td><?php echo $goods['receiver_name']; ?></td> <!-- Display the receiver's name -->
                            <td><?php echo $goods['total_quantity']; ?></td> <!-- Display the total quantity -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No goods have been sent yet.</p> <!-- Message if no goods are available -->
        <?php endif; ?>
        
        <footer>
            <p>ICT Intern Project by Gerard Uzodinma | &copy; 2024</p> <!-- Footer with copyright info -->
        </footer>
    </div>
</body>
</html>
