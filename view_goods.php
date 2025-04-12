<?php
// Start the session to access session variables
session_start();

// Include the configuration file for database connection
include 'config.php';

// Check if the user is logged in by verifying the role is set
if (!isset($_SESSION['role'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit(); // Stop further script execution
}

// Query to fetch all sent goods from the database, ordered by ID in descending order
$result = mysqli_query($conn, "SELECT * FROM sent_goods ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures responsive design -->
    <title>View Sent Goods - Emzor's Goods Outward Register</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file for styling -->
</head>
<body>
    <div class="view-container">
        <h2>Sent Goods</h2> <!-- Header for the page -->

        <table>
            <thead>
                <tr>
                    <th>Date</th> <!-- Column for the date of goods sent -->
                    <th>Sender's Location</th> <!-- Column for sender's location -->
                    <th>Sender's Name</th> <!-- Column for sender's name -->
                    <th>Receiver's Location</th> <!-- Column for receiver's location -->
                    <th>Receiver's Name</th> <!-- Column for receiver's name -->
                    <th>Total Quantity</th> <!-- Column for total quantity of goods -->
                    <th>Description</th> <!-- Column for description of goods -->
                    <th>Invoice/Order Number</th> <!-- Column for invoice/order number -->
                    <th>Authorised By</th> <!-- Column for the name of the person who authorised the goods -->
                    <?php if ($_SESSION['role'] == 'admin'): ?> <!-- Check if the user is an admin -->
                        <th>Actions</th> <!-- Column for actions, only visible to admin -->
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?> <!-- Loop through each row of the result set -->
                    <tr>
                        <td><?php echo $row['date']; ?></td> <!-- Display the date -->
                        <td><?php echo $row['sender_location']; ?></td> <!-- Display the sender's location -->
                        <td><?php echo $row['sender_name']; ?></td> <!-- Display the sender's name -->
                        <td><?php echo $row['receiver_location']; ?></td> <!-- Display the receiver's location -->
                        <td><?php echo $row['receiver_name']; ?></td> <!-- Display the receiver's name -->
                        <td><?php echo $row['total_quantity']; ?></td> <!-- Display the total quantity -->
                        <td><?php echo $row['description']; ?></td> <!-- Display the description of goods -->
                        <td><?php echo $row['invoice_number']; ?></td> <!-- Display the invoice/order number -->
                        <td><?php echo $row['authorised_by']; ?></td> <!-- Display the name of the person who authorised the goods -->
                        <?php if ($_SESSION['role'] == 'admin'): ?> <!-- If the user is an admin -->
                            <td>
                                <!-- Link to delete the record, with a confirmation dialog -->
                                <a href="delete_goods.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?> <!-- End of the loop -->
            </tbody>
        </table>
    </div>
</body>
</html>
