<?php
// Replace these with your desired passwords
$admin_password = "Emzor@24$";
$user_password = "Emzor@24#";

// Hash the passwords
$admin_hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
$user_hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

echo "Admin Hashed Password: " . $admin_hashed_password . "<br>";
echo "User Hashed Password: " . $user_hashed_password . "<br>";
?>