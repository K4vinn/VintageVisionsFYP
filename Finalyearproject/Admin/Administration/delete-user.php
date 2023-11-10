<?php
include("../Config/Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        // Perform the deletion query
        $delete_query = "DELETE FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $delete_query);

        if ($result) {
            echo 'Product deleted successfully';
        } else {
            echo 'Failed to delete product';
        }
    }
}
