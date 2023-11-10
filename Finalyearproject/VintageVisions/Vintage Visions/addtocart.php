<?php
include("../Config/Database.php");
session_start();

$current_url = $_SERVER['REQUEST_URI'];

$search_url = $current_url;

// Parse the URL
$url_parts = parse_url($search_url);

// Initialize the query_params array
$query_params = [];

// Parse the query string to get the parameters
if (isset($url_parts['query'])) {
    parse_str($url_parts['query'], $query_params);
}

// Extract the 'id' parameter if it exists
$id = isset($query_params['id']) ? $query_params['id'] : null;


if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_status = 0;
    $uuid = null;
    $ctotal = 1;

    // Get user ID and status
    if (isset($_SESSION['auth_user'])) {
        $user_status = 1;
        $uuid = $_SESSION['auth_user']['user_id'];
    } else {
        $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $uuid = $random_number; // Assign $random_number to $uuid
        $user_status = 0;

        $_SESSION['auth_user']['user_id'] = $uuid;
    }

    $check_product_sql = "SELECT * FROM `cart` WHERE `product_id`='$product_id' AND `user_id`='$uuid'";
    $check_product_query = mysqli_query($con, $check_product_sql);

    if (mysqli_num_rows($check_product_query) > 0) {
        // If the product already exists, increment cart_total by 1
        $update_cart_sql = "UPDATE `cart` SET `cart_total` = `cart_total` + 1 WHERE `product_id`='$product_id' AND `user_id`='$uuid'";
        $update_cart_query = mysqli_query($con, $update_cart_sql);

        if ($update_cart_query) {
            $_SESSION['success_message'] = "Cart updated successfully!";
        } else {
            echo "Failed to update cart.";
        }
    } else {
        // If the product does not exist, insert a new record
        $cart_sql = "INSERT INTO `cart`(`product_id`, `user_id`, `user_status`, `cart_total`) VALUES ('$product_id', '$uuid', '$user_status', '$ctotal')";
        $cart_query = mysqli_query($con, $cart_sql);

        if ($cart_query) {
            $_SESSION['success_message'] = "Added to cart successfully!";
        } else {
            echo "Failed to update cart.";
        }
    }
}
