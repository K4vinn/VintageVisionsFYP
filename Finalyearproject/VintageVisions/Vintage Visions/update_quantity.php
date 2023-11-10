<?php
include("../Config/Database.php");

if (isset($_POST["product_id"]) && isset($_POST["cart_total"])) {
    $product_id = $_POST["product_id"];
    $new_quantity = $_POST["cart_total"];

    // Use prepared statements to prevent SQL injection
    $update_query = "UPDATE cart SET cart_total = ? WHERE product_id = ?";
    $update_statement = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($update_statement, "ii", $new_quantity, $product_id);

    if (mysqli_stmt_execute($update_statement)) {
        echo "Quantity updated successfully"; // You can return a success message if needed
    } else {
        echo "Error updating quantity: " . mysqli_error($con); // Handle errors
    }
} else {
    echo "Invalid request"; // Handle invalid requests
}
