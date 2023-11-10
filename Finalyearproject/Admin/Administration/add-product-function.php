<?php
include("../Includes/admin-main.php");
// include("../Includes/admin-navbar.php");
include("../Config/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_variation = $_POST['product_variation'];
    $product_description = $_POST['product_description'];
    $product_stock = $_POST['product_stock'];

    // Handle file uploads
    // $targetDirectory = "../../VintageVisions/Images/"; // Directory to store images
    // $product_image = $_FILES['product_image']['name'];
    // $product_image_prev1 = $_FILES['product_image_prev1']['name'];
    // $product_image_prev2 = $_FILES['product_image_prev2']['name'];
    // $QRCode = $_FILES['QRCode']['name'];

    // move_uploaded_file($_FILES['product_image']['tmp_name'], $targetDirectory . $product_image);
    // move_uploaded_file($_FILES['product_image_prev1']['tmp_name'], $targetDirectory . $product_image_prev1);
    // move_uploaded_file($_FILES['product_image_prev2']['tmp_name'], $targetDirectory . $product_image_prev2);
    // move_uploaded_file($_FILES['QRCode']['tmp_name'], $targetDirectory . $QRCode);

    //product_image, product_image_prev1, product_image_prev2, QRCode

    // Insert query with file names
    $sql = "INSERT INTO products (product_name, product_price, product_category, product_variation, product_description, product_stock) VALUES (
            '$product_name',
            '$product_price',
            '$product_category',
            '$product_variation',
            '$product_description',
            '$product_stock'
            )";

    if (mysqli_query($con, $sql)) {
        echo "Record added successfully";
        header("Location: admin-product-control.php");
        exit();
    } else {
        echo "Error adding record: " . mysqli_error($con);
    }
}
