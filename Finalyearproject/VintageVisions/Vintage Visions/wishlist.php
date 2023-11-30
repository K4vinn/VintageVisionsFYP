<?php
session_start();
include("../Config/Database.php");

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

    // Get user ID and status
    if (isset($_SESSION['auth_user'])) {
        $uuid = $_SESSION['auth_user']['user_id'];
    }

    // Add to cart
    $wishlist_sql = "INSERT INTO `wishlist`(`product_id`, `user_id`) VALUES ('$product_id', '$uuid')";
    $wishlist_query = mysqli_query($con, $wishlist_sql);

    if ($wishlist_query) {
        $response = array("message" => "Product added to wishlist!");
        echo json_encode($response);
        exit();
    } else {
        $response = array("message" => "Failed to update wishlist.");
        echo json_encode($response);
        exit();
    }
}
