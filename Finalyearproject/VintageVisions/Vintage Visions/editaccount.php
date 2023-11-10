<?php
include "../Config/Database.php";

if (isset($_POST['submitacc'])) {
    $name = $_POST['full-name'];
    $email = $_POST['email'];
    $shipping_address = $_POST['shipping-address'];
    $phone_number = $_POST['phone-number'];

    // Check if the email already exists in the database
    $query = "SELECT user_id FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // If the email already exists, update the user's account information
        $update_query = "UPDATE users SET name = '$name', 
        user_shipping = '$shipping_address', user_phonenum = '$phone_number' WHERE email = '$email'";
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            // Account information updated successfully
            echo "Account information updated successfully.";
            header("Location: account.php");
        } else {
            // Error updating account information
            echo "Error updating account information: " . mysqli_error($con);
        }
    } else {
        // Email not found in the database, handle this case (e.g., show an error message)
        echo "Email not found in the database.";
    }
}
