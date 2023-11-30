<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$get_users = "SELECT * FROM users WHERE user_id = '$id'";
$get_users_results = mysqli_query($con, $get_users);

while ($row = mysqli_fetch_assoc($get_users_results)) {
    echo "<link rel='stylesheet' href='../Style/admin-product.css'>";
    echo "<form action='update-user.php' method='POST' class='product-form'>";
    echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
    echo "<label for='name'>Name</label><input type='text' name='name' value='" . $row['name'] . "'>";
    echo "<label for='email'>Email</label><input type='text' name='email' value='" . $row['email'] . "'>";
    echo "<label for='user_phonenum'>Phone Number</label><input type='text' name='user_phonenum' value='" . $row['user_phonenum'] . "'>";
    echo "<label for='user_shipping'>Shipping Information:</label><textarea name='user_shipping'>" . $row['user_shipping'] . "</textarea>";
    echo "<button type='submit' class='update-button'>Update</button>";
    echo "</form>";
}
