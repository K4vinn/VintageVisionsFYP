<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Update the status to 1 for the specified ID
    $update_query = "UPDATE support SET status = 1 WHERE id = $id";
    $result = mysqli_query($con, $update_query);

    if ($result) {
        header("Location: admin-support.php"); // Redirect back to the original page
        exit();
    } else {
        // Handle the case where the update query fails
        echo "Failed to update the status.";
    }
}
