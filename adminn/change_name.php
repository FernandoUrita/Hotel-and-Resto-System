<?php
session_start();
require 'inc/db_config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_admin_name = $_POST['new_admin_name'];
    $admin_id = $_SESSION['adminId'];

    // Update the admin_name in the database
    $stmt = $con->prepare("UPDATE admin SET admin_name = ? WHERE sr_no = ?");
    $stmt->bind_param("si", $new_admin_name, $admin_id);

    if ($stmt->execute()) {
        $_SESSION['admin_name'] = $new_admin_name; // Update session
        $_SESSION['message'] = "Admin name updated successfully!"; // Store success message
        header("Location: change_profile.php"); // Redirect to dashboard
        exit();
    } else {
        echo "Error updating name: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>