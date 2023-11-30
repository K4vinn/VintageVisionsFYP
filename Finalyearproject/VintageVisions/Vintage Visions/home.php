<?php include("../includes/header.php");
include("../Config/Database.php");
$isAuthorized = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;

$getProductDetails = "SELECT * from products";
$getProductDetailsResults = mysqli_query($con, $getProductDetails);



?>

<!-- Vector Images -->
<img class="vector-1" src="../Vectors/vector.png" />
<img class="sofa" src="../Vectors/sofa.png" />

<!-- Promo Text -->
<div class='promo'>
    <div class="crafted-with-love">Crafted<br />With<br />Love</div>

    <div class="promo-text">
        Limited time promotions for the Valentines sale!<br />40% Off Selective
        Items!
    </div>
</div>

<button id="button-shop" class="button-shop">
    <div class="shop-now">Shop Now</div>
</button>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Find the "Back to Catalogue" button by its class name
        var toShopButton = document.querySelector(".button-shop");

        // Add a click event listener to the button
        toShopButton.addEventListener("click", function() {
            // Specify the URL of your catalogue page
            var productsURL = "catalogue.php";

            // Use window.location.href to navigate to the catalogue URL
            window.location.href = productsURL;
        });
    });
</script>

<!-- Next Part -->

<div class="backdrop"></div>
<div class="rectangle-21">
    <a href="catalogue.php">
        <img class='bedroom' src="/Images/bedroom.png" alt="bedroom">
        <div class="overlay-bedroom">
            <p class="location-name">Bedroom</p>
        </div>
    </a>
</div>
<div class="rectangle-22">
    <a href="catalogue.php">
        <img class='living' src="/Images/livingroom.png" alt="living">
        <div class="overlay-living">
            <p class="location-name">Living Room</p>
        </div>
    </a>
</div>
<div class="rectangle-23">
    <a href="catalogue.php">
        <img class='dining' src="/Images/dining.png" alt="living">
        <div class="overlay-dining">
            <p class="location-name">Dining</p>
        </div>
    </a>
</div>

<!-- Featured Products -->
<div class="featured-products">Featured Products</div>
<div class="line-5"></div>

<?php

$sql = "SELECT * FROM products WHERE id = 5";
$getProductDetailsResults = mysqli_query($con, $sql);

if ($getProductDetailsResults && mysqli_num_rows($getProductDetailsResults) > 0) {
    $row = mysqli_fetch_assoc($getProductDetailsResults);
    $id = 5;
    echo '
    
            <div class="ft-1">
                <div class="rectangle-24">
                    <a href="products.php?product/link&id=' . $id . '">
                        <img class="dining-table" src="' . $row['product_image'] . '">
                    </a>
                </div>
                <div class="item-name">' . $row['product_name'] . '</div>
                <div class="price-rmxxxx">RM ' . $row['product_price'] . '</div>
                <div class="ellipse-3">
                    <i class="fa fa-heart custom-heart"></i>
                </div>
                <div class="ellipse-4">
                    <i class="fa fa-plus custom-plus"></i>
                </div>
            </div>';
}
?>

<?php

$sql = "SELECT * FROM products WHERE id = 6";
$getProductDetailsResults = mysqli_query($con, $sql);

if ($getProductDetailsResults && mysqli_num_rows($getProductDetailsResults) > 0) {
    $row = mysqli_fetch_assoc($getProductDetailsResults);
    $id = 6;
    echo '
        <div class="ft-2">
        <div class="rectangle-25">
            <a href="products.php?product/link&id=' . $id . '">
                <img class="featured-sofa" src="' . $row['product_image'] . '">
            </a>
        </div>
        <div class="item-name2">' . $row['product_name'] . '</div>
        <div class="price-rmxxxx2">RM ' . $row['product_price'] . '</div>

        <div class="ellipse-5">
            <i class="fa fa-heart custom-heart"></i>
        </div>
        <div class="ellipse-6">
            <i class="fa fa-plus custom-plus"></i>
        </div>
    </div>';
}
?>

<?php

$sql = "SELECT * FROM products WHERE id = 7";
$getProductDetailsResults = mysqli_query($con, $sql);

if ($getProductDetailsResults && mysqli_num_rows($getProductDetailsResults) > 0) {
    $row = mysqli_fetch_assoc($getProductDetailsResults);
    $id = 7;
    echo
    '
        <div class="ft-3">
        <div class="rectangle-26">
            <a href="products.php?product/link&id=' . $id . '">
                <img class="featured-sofa-2" src="' . $row['product_image'] . '">
            </a>
        </div>
        <div class="item-name3">' . $row['product_name'] . '</div>
        <div class="price-rmxxxx3">RM ' . $row['product_price'] . '</div>

        <div class="ellipse-7">
            <i class="fa fa-heart custom-heart"></i>
        </div>
        <div class="ellipse-8">
            <i class="fa fa-plus custom-plus"></i>
        </div>
    </div>';
}

?>

<?php

$sql = "SELECT * FROM products WHERE id = 8";
$getProductDetailsResults = mysqli_query($con, $sql);

if ($getProductDetailsResults && mysqli_num_rows($getProductDetailsResults) > 0) {
    $row = mysqli_fetch_assoc($getProductDetailsResults);
    $id = 8;
    echo '
    <div class="ft-4">
    <div class="rectangle-27">
            <a href="products.php?product/link&id=' . $id . '">
                <img class="featured-bedroom" src="' . $row['product_image'] . '">
            </a>
        </div>
        <div class="item-name4">' . $row['product_name'] . '</div>
        <div class="price-rmxxxx4">RM ' . $row['product_price'] . '</div>

    <div class="ellipse-9">
        <i class="fa fa-heart custom-heart"></i>
    </div>
    <div class="ellipse-10">
        <i class="fa fa-plus custom-plus"></i>
    </div>
</div>
        ';
}

?>

<button id="ctlg-btn" class="ctlg-btn">
    <div class="catalogue-text">Shop Now</div>
</button>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Find the "Back to Catalogue" button by its class name
        var ctlg = document.querySelector(".ctlg-btn");

        // Add a click event listener to the button
        ctlg.addEventListener("click", function() {
            // Specify the URL of your catalogue page
            var toproduct = "catalogue.php";

            // Use window.location.href to navigate to the catalogue URL
            window.location.href = toproduct;
        });
    });
</script>

<!-- Promo again -->
<div class="cta-box">
    <button id="cta-btn" class="cta-btn">
        <div class="discount-text-1">Become a member now!</div>
    </button>
    <div class="discount-text-2">Its<br />Discount<br />Season!</div>
    <div class="line-6"></div>
    <div class="terms">
        Become a member now and receive emails of our weekly discounts!
        <br />
        <br />
        Terms and conditions applied*
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Find the "Back to Catalogue" button by its class name
        var ctabtn = document.querySelector(".cta-btn");
        var isAuthorized = <?php echo ($isAuthorized) ? 'true' : 'false'; ?>;

        if (!isAuthorized) {
            // Add a click event listener to the button
            ctabtn.addEventListener("click", function() {
                // Specify the URL of your catalogue page
                var login = "../login.php";

                // Use window.location.href to navigate to the catalogue URL
                window.location.href = login;
            });
        } else {
            // Add a click event listener to the button
            ctabtn.addEventListener("click", function() {
                // Specify the URL of your catalogue page
                var account = "account.php";

                // Use window.location.href to navigate to the catalogue URL
                window.location.href = account;
            });
        }
    });
</script>

<!-- Testimonies -->
<div class="testimonies"> Testimonies </div>
<div class="line-7"></div>
<div class="testimonies-box">
    <div class="testimony-card">
        <p>"I was blown away by the quality and variety at this furniture store. The customer service was exceptional, and they helped me find the perfect pieces to transform my living room. I couldn't be happier with my purchase!"</p>
        <h2>Samatha H.</h2>

    </div>
    <div class="testimony-card">
        <p>"I recently furnished my entire home from this store, and the experience was fantastic. The furniture is not only stylish but also durable. The delivery was prompt, and everything arrived in perfect condition. Highly recommended!"</p>
        <h2>John M.</h2>

    </div>
    <div class="testimony-card">
        <p>"I stumbled upon this furniture store, and it was a hidden gem. The prices were reasonable, and the selection was impressive. I found unique pieces that I couldn't find anywhere else. My home now feels like a design magazine come to life. Thanks to the team for their expertise and assistance!"</p>
        <h2>Emily T.</h2>
    </div>
</div>