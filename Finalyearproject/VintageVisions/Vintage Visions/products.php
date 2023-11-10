<?php
include("../includes/header.php");
include("../Config/Database.php");
session_start();

$isAuthorized = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;

$current_url = $_SERVER['REQUEST_URI'];

$search_url = $current_url;

// Parse the URL
$url_parts = parse_url($search_url);

// Initialize the query_params array
$query_params = [];

// Parse the query string to get the parameters
if (isset($url_parts['query'])) {
    parse_str($url_parts['query'], $query_params);
}

// Extract the 'id' parameter if it exists
$id = isset($query_params['id']) ? $query_params['id'] : null;

$get_products = "SELECT * FROM products";
$products_results = mysqli_query($con, $get_products);

if ($id !== null) {
    $get_products = "SELECT * FROM products WHERE id = $id";
    $products_results = mysqli_query($con, $get_products);

    if ($products_results && mysqli_num_rows($products_results) > 0) {
        $row = mysqli_fetch_assoc($products_results);

        echo '<div class="prod-box">';
        if (!isset($_SESSION['authorized'])) {
            echo "<h3 class='welcome'> Welcome, Guest! </h3>";
        } else {
            echo "<h3 class='welcome'> Welcome, User! </h3>";
        }

        echo '<button id="wishlist" class="circle">';
        echo '<i class="fa fa-heart wishlist-icon"></i>';
        echo '</button>';
        echo '<div class="QR-box"><img class="productimage" src="' . $row['QRCode'] . '"></div>';
        echo '<ul class="prod-info">';
        echo '<li> Products / Category / ' . $row['product_category'] . '</li>';
        echo '<li>' . $row['product_name'] . '</li>';
        echo '<li> MYR ' . $row['product_price'] . '</li>';
        echo '<li> Variation: ' . $row['product_variation'] . '</li>';
        echo '</ul>';
        echo '<div class="img-container">';
        echo '<button id="atc" class="add-to-cart" data-product-id=' . $row['id'] . '>';
        echo '<div class="add-cart-btn"> Add To Cart </div>';
        echo '</button>';
        echo '<div class="prod-image">';
        echo '<img class="productimage" src="' . $row['product_image'] . '">';
        echo '</div>';
        echo ' <div class="preview-1"><img class="productimage" src="' . $row['product_image_prev1'] . '"></div>';
        echo ' <div class="preview-2"><img class="productimage" src="' . $row['product_image_prev2'] . '"></div>';
        echo '<div class="desc">';
        echo '<h2 class="desc-header"> Product Details </h2>';
        echo '<br />';
        echo '<h2 class="desc-details">' . $row['product_description'] . '</h2>';
        echo '<br />';
        echo '<ul class="prod-desc">';
        echo '<li> Variation: ' . $row['product_variation'] . '</li>';
        echo '<li> Category: ' . $row['product_category'] . '</li>';
        echo '<li> Dimensions: 45 inches x 38 inches x 20 inches (WDH) </li>';
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
?>

<div class="info-header"> Furniture </div>

<div class="alert-box-wishlist" style="display: none;">
    <h5 class="confirmation-text"> Succesfully added to Wishlist! </h5>
</div>

<div class="alert-box-cart" style="display: none;">
    <h5 class="confirmation-text"> Added to cart </h5>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successModal = document.getElementById("successModal");

        // Display the modal
        successModal.style.display = "block";

        // Hide the modal after 4 seconds
        setTimeout(function() {
            successModal.style.display = "none";
        }, 2000);
    });
</script>

<!-- if not logged in then display -->
<div id="wishlistModal" class="modalwishlist">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2> Wait? Are you looking to save this item for later? Don't worry! </h2>
        <p>Login or Register an account now!</p>
        <button class="wishlist-login-modal">
            <div> Login Now </div>
        </button>
    </div>
</div>

<!-- 
<div class='recommendations'>
    <div class="personal-header4"> More like this! </div>
    <div class="more-item1"></div>
    <div class="more-item2"></div>
    <div class="more-item3"></div>
</div> -->

<!-- Scripts -->
<script>
    // Wishlist
    // Get the button and the modal elements
    document.addEventListener("DOMContentLoaded", function() {
        var signinModal = document.getElementById("wishlistModal");
        var closeModal = document.getElementById("closeModal");
        signinModal.style.display = "none";

        var isAuthorized = <?php echo ($isAuthorized) ? 'true' : 'false'; ?>;
        var wishlistButton = document.getElementById("wishlist");
        var confirmationMessage = document.querySelector('.alert-box-wishlist');


        wishlistButton.addEventListener("click", function() {
            if (!isAuthorized) {
                signinModal.style.display = "block";
            } else {
                var productId = <?php echo $id; ?>;
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "wishlist.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                var data = "product_id=" + productId;

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.message === "Product added to wishlist!") {
                            console.log("Product added to wishlist!");
                            confirmationMessage.style.display = "block"; // Display confirmation message
                            setTimeout(function() {
                                confirmationMessage.style.display = 'none';
                            }, 4000);

                            // You can update UI or display a message for successful addition
                        } else {
                            console.log("Failed to add product to wishlist.");
                            // Handle failure, show an error message or take other actions
                        }
                    } else {
                        console.log("Request failed.");
                        // Handle request failure, show an error message or take other actions
                    }
                };

                xhr.send(data);
            }
        });

        closeModal.addEventListener("click", function() {
            signinModal.style.display = "none";
        });

        window.onclick = function(event) {
            if (event.target === signinModal) {
                signinModal.style.display = "none";
            }
        };
    });

    //add to cart
    document.getElementById("atc").addEventListener("click", function() {
        var productId = this.getAttribute("data-product-id");
        var confirmationMessage = document.querySelector('.alert-box-cart');

        // Create an XMLHttpRequest object (or use the fetch API as shown in previous examples)
        var xhr = new XMLHttpRequest();

        // Specify the request method (POST) and the URL of your PHP script
        xhr.open("POST", "addtocart.php", true);

        // Set the request headers (if needed)
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Define the data to be sent in the request (include the product ID)
        var data = "product_id=" + productId; // You can include additional data as needed

        // Set up a function to handle the response from the server
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                confirmationMessage.style.display = "block"; // Display confirmation message
                setTimeout(function() {
                    confirmationMessage.style.display = 'none';
                }, 4000);
                console.log(xhr.responseText);
            } else {
                // Handle errors or failed requests
                console.error("Request failed with status: " + xhr.status);
            }
        };

        // Send the request with the data
        xhr.send(data);
    });

    //guest button
    document.getElementById("guest-btn").addEventListener("click", function() {
        var productId = this.getAttribute("data-product-id");
        var xhr = new XMLHttpRequest();

        xhr.open("POST", "addtocart.php", true);

        // Set the request headers (if needed)
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Define the data to be sent in the request (include the product ID)
        var data = "product_id=" + productId; // You can include additional data as needed

        // Set up a function to handle the response from the server
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Handle the response from the addtocart.php script
                console.log(xhr.responseText);

                // You can perform additional actions here, such as updating the UI
            } else {
                // Handle errors or failed requests
                console.error("Request failed with status: " + xhr.status);
            }
        };

        // Send the request with the data
        xhr.send(data);
    });
</script>