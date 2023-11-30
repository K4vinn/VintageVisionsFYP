<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

?>

<link rel='stylesheet' href='../Style/admin-product.css'>
<form action='add-product-function.php' method='POST' class='product-form' enctype="multipart/form-data">
    <input type='hidden' name='id' value=''>
    <label for='product_name'>Product Name:</label><input type='text' name='product_name' value=''>
    <label for='product_price'>Product Price:</label><input type='text' name='product_price' value=''>
    <label for='product_category'>Product Category:</label><input type='text' name='product_category' value=''>
    <label for='product_variation'>Product Variation:</label><input type='text' name='product_variation' value=''>
    <label for='product_description'>Product Description:</label><textarea name='product_description'></textarea>
    <label for='product_stock'>Stock</label><input type='text' name='product_stock' value=''>
    <label for='product_image'>Product Image:</label><input type='file' name='product_image' value=''>
    <label for='image_prev_1'>Image Preview 1:</label><input type='file' name='product_image_prev1' value=''>
    <label for='image_prev_2'>Image Preview 2:</label><input type='file' name='product_image_prev2' value=''>
    <label for='qr_code'>QR Code:</label><input type='file' name='QRcode' value=''>
    <br />
    <button type='submit' class='update-button'>Add Product</button>
</form>