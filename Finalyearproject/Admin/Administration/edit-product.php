<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$get_products = "SELECT * FROM products WHERE id = '$id'";
$get_products_results = mysqli_query($con, $get_products);


while ($row = mysqli_fetch_assoc($get_products_results)) {
    echo "<link rel='stylesheet' href='../Style/admin-product.css'>";
    echo "<form action='update-product.php' method='POST' class='product-form'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<label for='product_name'>Product Name:</label><input type='text' name='product_name' value='" . $row['product_name'] . "'>";
    echo "<label for='product_price'>Product Price:</label><input type='text' name='product_price' value='" . $row['product_price'] . "'>";
    echo "<label for='product_category'>Product Category:</label><input type='text' name='product_category' value='" . $row['product_category'] . "'>";
    echo "<label for='product_variation'>Product Variation:</label><input type='text' name='product_variation' value='" . $row['product_variation'] . "'>";
    echo "<label for='product_description'>Product Description:</label><textarea name='product_description'>" . $row['product_description'] . "</textarea>";
    echo "<label for='product_stock'>Stock</label><input type='text' name='product_stock' value='" . $row['product_stock'] . "'>";
    echo "<button type='submit' class='update-button'>Update</button>";
    echo "</form>";
}
