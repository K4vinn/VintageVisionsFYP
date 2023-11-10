<?php
// filter_products.php

// Include your database connection code if not already included
include("../Config/Database.php");

// Get the selected category from the POST request
if (isset($_POST['category'])) {
    $selectedCategory = $_POST['category'];

    // Build and execute a query to retrieve products based on the selected category
    $query = "SELECT * FROM products WHERE product_category = '$selectedCategory'";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Loop through the results and generate the HTML for the filtered products
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a class="product-link" href="products.php?product/link&id=' . $row['id'] . '">';
            echo '<div class="product-card">';
            echo '<div class="product-box">';
            echo '<img class="product-image" src="' . $row['product_image'] . '">';
            echo '</div>';
            echo '<div class="product-name">' . $row['product_name'] . '</div>';
            echo '<div class="product-price"> RM ' . $row['product_price'] . '</div>';
            echo '</div>';
            echo '</a>';
        }
    } else {
        echo 'No products found for the selected category.';
    }
} else {
    echo 'Category not specified.';
}
