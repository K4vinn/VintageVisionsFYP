<?php
include("../Config/Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Perform the deletion query
        $delete_query = "DELETE FROM products WHERE id = '$id'";
        $result = mysqli_query($con, $delete_query);

        if ($result) {
            echo 'Product deleted successfully';
        } else {
            echo 'Failed to delete product';
        }
    }
}
