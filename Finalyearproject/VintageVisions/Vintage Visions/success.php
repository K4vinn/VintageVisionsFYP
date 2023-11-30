<?php
include("../Config/Database.php");
include("../includes/header.php");
require_once('../stripe/init.php');
\Stripe\Stripe::setApiKey('sk_test_51O3YulBeyFElC0Gu6xce0cmALCObUNdObE1Fbdd11ca3XCdahNW55cWiqTGOL2CmxRaQzgwIhTLG7dSTxFjt08yR00DrVIjHok');

$user_id = $_SESSION['auth_user']['user_id'];

if (isset($_SESSION['stripe_checkout_session_id'])) {
    $sessionId = $_SESSION['stripe_checkout_session_id'];

    $delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
    $delete_cart_query = mysqli_query($con, $delete_cart);

    try {
        // Retrieve the session using the session ID
        $checkout_session = \Stripe\Checkout\Session::retrieve($sessionId);

        // Extract the payment details
        $paymentIntentId = $checkout_session->payment_intent; // Payment id
        $customerDetails = $checkout_session->customer_details; // Customer detail

        // Retrieve email
        if ($customerDetails && isset($customerDetails['email'])) {
            $paymentEmail = $customerDetails['email'];
        } else {
            echo "No email found in customer details.";
        }

        // Retrieve payment amount, status, or other payment details
        $paymentAmount = $checkout_session->amount_total / 100; // Payment amount
        $status = "Complete";

        $paymentquery = "SELECT * FROM payments WHERE user_id = '$user_id'";
        $paymentqueryresults = mysqli_query($con, $paymentquery);

        if ($paymentqueryresults) {
            if (mysqli_num_rows($paymentqueryresults) > 0) {
                $updateQuery = "UPDATE payments SET payment_id = '$paymentIntentId', email = '$paymentEmail', status = '$status' WHERE user_id = '$user_id'";
                $updateResult = mysqli_query($con, $updateQuery);
                if (!$updateResult) {
                    echo "Error inserting payment details: " . mysqli_error($con);
                    // Handle the error as needed
                } else {
                    echo "<h1 class='success-message'> Payment was successful. <br/> Your product will be shipped within 3-5 working days. <br/> Please stand by for an email. </h1>";
                    echo "<button class='return-home' onclick='returnHome()'>
        Return to Home!

    </button>";
                }
            } else {
                $insertQuery = "INSERT INTO payments (payment_id, email, status, user_id) VALUES ('$paymentIntentId', '$paymentEmail', '$status', '$user_id')";
                $insertQueryRes = mysqli_query($con, $insertQuery);
            }
        }



        // Close the connection
        mysqli_close($con);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "There was no session found and there was nothing to be saved to the database, Please recheck.";
}

?>

<link rel="stylesheet" href="../Style/success.css">
<script>
    // JavaScript function to redirect to home.php
    function returnHome() {
        // Redirect to home.php
        window.location.href = 'home.php';
    }
</script>