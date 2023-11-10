<?php
include("../Config/Database.php");
include("../includes/header.php");
require_once('../stripe/init.php');
\Stripe\Stripe::setApiKey('sk_test_51O3YulBeyFElC0Gu6xce0cmALCObUNdObE1Fbdd11ca3XCdahNW55cWiqTGOL2CmxRaQzgwIhTLG7dSTxFjt08yR00DrVIjHok');

session_start();

$user_id = $_SESSION['auth_user']['user_id'];

$cart_items = array();
$get_checkout = "SELECT p.id, p.product_name, p.product_price, p.product_image, c.cart_total 
                 FROM cart AS c 
                 INNER JOIN products AS p ON p.id = c.product_id 
                 WHERE c.user_id = '$user_id'";

$checkout_results = mysqli_query($con, $get_checkout);

$total = 0;

if ($checkout_results->num_rows > 0) {
    $productIds = array(); // Initialize an array to store product IDs

    while ($row = $checkout_results->fetch_assoc()) {
        $productIds[] = $row['id']; // Store each product ID
        $cartTotal = $row['cart_total'];
        $productPrice = $row['product_price'];
        $rowTotal = $cartTotal * $productPrice;
        $total += $rowTotal;

        // Display the items in the checkout
        echo '<div class="checkout-item-box">
            
        </div>';
    }

    // JSON encode product IDs
    $jsonString = json_encode($productIds);

    if (!empty($jsonString)) {
        // Insert the JSON string into the database (you might want to use prepared statements to prevent SQL injection)
        $insertQuery = "INSERT INTO payments (user_id, product_id) VALUES ('$user_id', '$jsonString')";
        $insertResult = mysqli_query($con, $insertQuery);

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'MYR',
                            'unit_amount' => $total * 100,
                            'product_data' => [
                                'name' => 'Vintage Visions Furniture',
                            ],
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => 'http://localhost:8000/VintageVisions/Vintage%20Visions/success.php',
                'cancel_url' => 'http://localhost:8000/VintageVisions/Vintage%20Visions/failed.php',
            ]);

            $sessionId = $session->id; // Retrieve the session ID

            session_start();
            // Store the session ID in the session or database for future use
            $_SESSION['stripe_checkout_session_id'] = $sessionId; // Store the session ID in the session

            header("Location: " . $session->url);
            exit;
        } catch (\Stripe\Exception\ApiErrorException $e) {

            echo "Error: " . $e->getMessage();
        }

        if (!$insertResult) {
            echo "Error inserting data: " . mysqli_error($con);
            // Handle the error as needed
        } else {
            echo "Data inserted successfully!";
        }
    } else {
        echo "Error: JSON string is empty.";
    }
} else {
    echo "No items in the cart.";
}

?>

<div class="checkout-flexbox">
    <!-- Display your checkout content here -->

    <div class="checkout-tprice">
        <span>
            <span class="checkout-tprice-span">Total Price : RM </span>
            <span class="checkout-tprice-span2"><?php echo $total; ?></span> <!-- Display your total here -->
        </span>
    </div>

    <button id="checkout-button" class="confirm-checkout-btn">
        <div class="confirm-text">
            Confirm Checkout
        </div>
    </button>
</div>

<link rel='stylesheet' href='../Style/Checkout.css' />

<div class="checkout-header">
    Checkout
</div>