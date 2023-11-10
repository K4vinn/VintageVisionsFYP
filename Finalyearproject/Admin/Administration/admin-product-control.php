<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

$get_products = "SELECT * FROM products";
$get_products_results = mysqli_query($con, $get_products)
?>

<link rel="stylesheet" href="../Style/admin-product.css">

<h1 class='control-header'> Product Control </h1>
<p class='control-desc'> Manage products from adding, deleting and editing, and stock control </p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Variation</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Product Image</th>
            <th>Preview 1</th>
            <th>Preview 2</th>
            <th>QR Code</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($get_products_results)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['product_price'] . "</td>";
            echo "<td>" . $row['product_category'] . "</td>";
            echo "<td>" . $row['product_variation'] . "</td>";
            echo "<td>" . $row['product_description'] . "</td>";
            echo "<td>" . $row['product_stock'] . "</td>";
            echo "<td><img src='" . $row['product_image'] . "' width='100' height='100'></td>";
            echo "<td><img src='" . $row['product_image_prev1'] . "' width='100' height='100'></td>";
            echo "<td><img src='" . $row['product_image_prev2'] . "' width='100' height='100'></td>";
            echo "<td><img src='" . $row['QRCode'] . "' width='100' height='100'></td>";
            echo "<td>
        <button class='edit-button' onclick=\"window.location.href='edit-product.php?id=" . $row['id'] . "'\">
            <div>
                Edit Product
            </div>
        </button>
        <button class='delete-button' data-product-id='" . $row['id'] . "'>
            <div>
                Delete Product
            </div>
        </button>
    </td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<button class="add-product" onclick="window.location.href='add-product.php'">
    <div>
        Add product
    </div>
</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function() {
            var productId = $(this).data('product-id');

            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    type: 'POST',
                    url: 'delete-product.php',
                    data: {
                        id: productId
                    },
                    success: function(response) {
                        // Refresh or update the table after successful deletion
                        // For example, you could reload the page:
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        // Handle error if deletion fails
                    }
                });
            }
        });
    });
</script>