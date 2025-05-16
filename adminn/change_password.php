<?php
session_start();
require 'inc/db_config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $admin_id = $_SESSION['adminId']; // Assume admin is logged in with session

    // Fetch current password from the database
    $stmt = $con->prepare("SELECT admin_pass FROM admin WHERE sr_no=?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify current password
    if (!password_verify($current, $hashed_password)) {
        $_SESSION['error'] = "Incorrect current password.";
        header("Location: change_password.php");
        exit();
    }

     // Check if new passwords match
     if ($new !== $confirm) {
        $_SESSION['error'] = "New passwords do not match.";
        header("Location: change_password.php");
        exit();
    }

    // Hash the new password
    $new_hashed = password_hash($new, PASSWORD_DEFAULT);

    // Update password in the database
    $stmt = $con->prepare("UPDATE admin SET admin_pass=? WHERE sr_no=?");
    $stmt->bind_param("si", $new_hashed, $admin_id);
    $stmt->execute();
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Password changed successfully!";
        header("Location: change_profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating password.";
        header("Location: change_password.php");
        exit();
    }

    $stmt->close();
    $con->close();

}
?>
