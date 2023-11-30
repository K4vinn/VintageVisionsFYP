<?php
session_start();
include("../Config/Database.php");

if (isset($_SESSION['auth_user']['user_id'])) {
    $user_id = $_SESSION['auth_user']['user_id'];
    $product_id = $_POST["product_id"];

    $delete_query = "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        // Return a success message or indicator back to the JavaScript
        echo "Item deleted successfully";
        header('wishlist.php');
    } else {
        // Return an error message back to the JavaScript
        echo "Failed to delete item";
    }
} else {
    // Handle the case where the user is not logged in
    echo "User not logged in";
}
