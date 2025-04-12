<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Goods - Emzor's Goods Outward Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="register-container">
        <h2>Register Goods</h2>

        <?php
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capture the form data
            $date = $_POST['date'];
            $sender_location = $_POST['sender_location'];
            $sender_name = $_POST['sender_name'];
            $receiver_location = $_POST['receiver_location'];
            $receiver_name = $_POST['receiver_name'];
            $total_quantity = $_POST['total_quantity'];
            $description = $_POST['description'];
            $invoice_number = $_POST['invoice_number'];
            $authorised_by = $_POST['authorised_by'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'emzor_goods_outward_register');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Insert data into the sent_goods table
            $sql = "INSERT INTO sent_goods (date, sender_location, sender_name, receiver_location, receiver_name, total_quantity, description, invoice_number, authorised_by) 
                    VALUES ('$date', '$sender_location', '$sender_name', '$receiver_location', '$receiver_name', '$total_quantity', '$description', '$invoice_number', '$authorised_by')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Goods registered successfully!</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

            // Close the connection
            $conn->close();
        }
        ?>

        <form action="register_goods.php" method="post">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="sender_location">Sender's Location:</label>
            <input type="text" id="sender_location" name="sender_location" required>
            
            <label for="sender_name">Sender's Name:</label>
            <input type="text" id="sender_name" name="sender_name" required>
            
            <label for="receiver_location">Receiver's Location:</label>
            <input type="text" id="receiver_location" name="receiver_location" required>
            
            <label for="receiver_name">Receiver's Name:</label>
            <input type="text" id="receiver_name" name="receiver_name" required>
            
            <label for="total_quantity">Total Quantity of Goods:</label>
            <input type="number" id="total_quantity" name="total_quantity" required>
            
            <label for="description">Description of Goods:</label>
            <textarea id="description" name="description" required></textarea>
            
            <label for="invoice_number">Invoice/Order Number (Optional):</label>
            <input type="text" id="invoice_number" name="invoice_number">
            
            <label for="authorised_by">Authorised By:</label>
            <input type="text" id="authorised_by" name="authorised_by" required>
            
            <button type="submit">Register Goods</button>
        </form>
    </div>
</body>
</html>
