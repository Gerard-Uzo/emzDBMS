<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures responsive design -->
    <title>Emzor's Goods Outward Register - Login</title> <!-- Title of the webpage -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file for styling -->
</head>
<body>
    <div class="login-container">
        <img src="emzor_logo.png" alt="Emzor Logo" class="logo"> <!-- Displays the company logo -->
        <h2>Login</h2>

        <?php
        // Start the session to manage user login states
        session_start();
        include 'config.php'; // Include the config file for database connection

        // Check if the login form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve the username, password, and role from the form
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // Prepare an SQL statement to fetch user data based on username and role
            $sql = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
            $sql->bind_param("ss", $username, $role); // Bind the parameters to prevent SQL injection
            $sql->execute(); // Execute the prepared statement
            $result = $sql->get_result(); // Get the result of the query

            // Check if a matching user was found
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc(); // Fetch the user data
                // Verify the provided password against the stored hashed password
                if (password_verify($password, $user['password'])) {
                    // Set session variables for the logged-in user
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    // Redirect to the appropriate dashboard based on user role
                    if ($user['role'] == 'admin') {
                        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
                    } else {
                        header("Location: user_dashboard.php"); // Redirect to user dashboard
                    }
                    exit; // Stop further script execution after redirection
                } else {
                    // Display an error message if the password is incorrect
                    echo "<p>Invalid password. Please try again.</p>";
                }
            } else {
                // Display an error message if no user is found with the given credentials
                echo "<p>User not found or incorrect role selected. Please try again.</p>";
            }
        }
        ?>

        <!-- Login form where users enter their credentials -->
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required> <!-- Input for username -->
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required> <!-- Input for password -->
            
            <label for="role">Sign in as:</label>
            <select id="role" name="role"> <!-- Dropdown to select user role -->
                <option value="user">User</option>
                <option value="admin">Administrator</option>
            </select>
            
            <button type="submit">Login</button> <!-- Login button -->
        </form>

        <footer>
            <p>&copy; 2024 ICT Intern Project by Gerard Uzodinma</p> <!-- Footer with copyright -->
        </footer>
    </div>
</body>
</html>
