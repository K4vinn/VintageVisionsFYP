<?php
session_start();
include("../Config/Database.php");

if (isset($_POST['confirm_delete'])) {
    // Initialize your database connection ($con) here.

    // Delete the user's account
    $id = $_SESSION['user_id']; // Get the user's ID from the session
    $delete_query = "DELETE FROM users WHERE user_id = ?";

    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Account deleted successfully
        // Log out the user
        session_destroy();
        header('Location: confirmation_page.php'); // Redirect to a confirmation page
    } else {
        // Handle the case where the deletion failed (e.g., display an error message).
        echo "Error deleting the account: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt); // Close the prepared statement
}
