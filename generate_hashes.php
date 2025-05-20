<?php
// Generate new password hashes
$new_admin_password = "NewSecureAdminPass2024!"; // You should change this to your desired password
$new_user_password = "NewSecureUserPass2024!"; // You should change this to your desired password

$admin_hash = password_hash($new_admin_password, PASSWORD_DEFAULT);
$user_hash = password_hash($new_user_password, PASSWORD_DEFAULT);

echo "New Admin Password Hash: " . $admin_hash . "\n";
echo "New User Password Hash: " . $user_hash . "\n";
?>