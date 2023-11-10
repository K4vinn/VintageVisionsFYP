<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_phonenum = $_POST['user_phonenum'];
    $user_shipping = $_POST['user_shipping'];

    // Update query
    $sql = "UPDATE users SET 
            name = '$name',
            email = '$email',
            user_phonenum = '$user_phonenum',
            user_shipping = '$user_shipping'
            WHERE user_id = $user_id";

    if (mysqli_query($con, $sql)) {
        echo "Record updated successfully";
        header("Location: admin-user-control.php");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
