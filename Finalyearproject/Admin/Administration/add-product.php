<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

$get_products = "SELECT * FROM products";
$get_products_results = mysqli_query($con, $get_products);


while ($row = mysqli_fetch_assoc($get_products_results)) {
    echo "<link rel='stylesheet' href='../Style/admin-product.css'>";
    echo "<form action='add-product-function.php' method='POST' class='product-form'>";
    echo "<input type='hidden' name='id' value=''>";
    echo "<label for='product_name'>Product Name:</label><input type='text' name='product_name' value=''>";
    echo "<label for='product_price'>Product Price:</label><input type='text' name='product_price' value=''>";
    echo "<label for='product_category'>Product Category:</label><input type='text' name='product_category' value=''>";
    echo "<label for='product_variation'>Product Variation:</label><input type='text' name='product_variation' value=''>";
    echo "<label for='product_description'>Product Description:</label><textarea name='product_description'></textarea>";
    echo "<label for='product_stock'>Stock</label><input type='text' name='product_stock' value=''>";
    // echo "<label for='product_image'>Product Image:</label><input type='file' name='product_image'>";
    // echo "<label for='product_image_prev1'>Product Image Prev 1:</label><input type='file' name='product_image_prev1'>";
    // echo "<label for='product_image_prev2'>Product Image Prev 2:</label><input type='file' name='product_image_prev2'>";
    // echo "<label for='QRCode'>QR Code:</label><input type='file'' name='QRCode'>";
    echo "<br/>";
    echo "<button type='submit' class='update-button'>Add Product</button>";
    echo "</form>";
}
