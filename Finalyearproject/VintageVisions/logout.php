<?php

if (isset($_POST['logout'])) {
    // User clicked the "Logout" button
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect the user to a login or home page
    header('Location: login.php'); // Replace with the URL of your login page
    exit();
}
