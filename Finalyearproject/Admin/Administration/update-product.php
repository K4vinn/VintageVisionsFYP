<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_variation = $_POST['product_variation'];
    $product_description = $_POST['product_description'];
    $product_stock = $_POST['product_stock'];
    $product_image = $_POST['product_image'];
    $product_image_prev1 = $_POST['product_image_prev1'];
    $product_image_prev2 = $_POST['product_image_prev2'];
    $QRCode = $_POST['QRCode'];

    // Update query
    $sql = "UPDATE products SET 
            product_name = '$product_name',
            product_price = '$product_price',
            product_category = '$product_category',
            product_variation = '$product_variation',
            product_description = '$product_description',
            product_stock = '$product_stock',
            product_image = '$product_image',
            product_image_prev1 = '$product_image_prev1',
            product_image_prev2 = '$product_image_prev2',
            QRCode = '$QRCode'
            WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        echo "Record updated successfully";
        header("Location: admin-product-control.php");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
