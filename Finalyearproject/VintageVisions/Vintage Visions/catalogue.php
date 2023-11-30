<?php
include("../includes/header.php");
include("../Config/Database.php");

if (isset($_SESSION["email"])) {
    $email = $_SESSION['email'];
}

$get_products = "SELECT * FROM products";
$products_results = mysqli_query($con, $get_products);
?>

<div class="catalogue-header"> Catalogue </div>

<div class="card-design">
    <div class="filter">
        <h1> Filter </h1>
        <select class="prod-category" id="category-filter">
            <option value="all">All Categories</option>
            <option value="Living Room">Living Room</option>
            <option value="Bedroom">Bedroom</option>
            <option value="Kitchen">Kitchen</option>
            <option value="Dining">Dining</option>
        </select>
    </div>
    <div class="product-grid">
        <?php
        while ($row = $products_results->fetch_assoc()) {
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
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Event listener for category filter changes
        $("#category-filter").change(function() {
            var selectedCategory = $(this).val();

            // Perform an AJAX request to fetch filtered products
            $.ajax({
                url: "filter-products.php", // Replace with the actual URL of your server-side script
                method: "POST",
                data: {
                    category: selectedCategory
                },
                success: function(data) {
                    // Update the product grid with the filtered results
                    $(".product-grid").html(data); // Corrected selector
                }
            });
        });
    });
</script>