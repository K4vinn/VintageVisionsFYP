<?php
// Include Stripe PHP library and set the API key
require_once 'path-to-stripe-php/init.php';
\Stripe\Stripe::setApiKey('sk_test_51O3YulBeyFElC0Gu6xce0cmALCObUNdObE1Fbdd11ca3XCdahNW55cWiqTGOL2CmxRaQzgwIhTLG7dSTxFjt08yR00DrVIjHok');

// Calculate the total amount in cents
$total = 5000; // Replace with your calculated total amount in cents

// Create a Checkout Session
$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [
        [
            'price_data' => [
                'currency' => 'myr',
                'unit_amount' => $total,
                'product_data' => [
                    'name' => 'Your Product Name',
                    'images' => ['https://example.com/your-image.jpg'],
                ],
            ],
            'quantity' => 1,
        ],
    ],
    'mode' => 'payment',
    'success_url' => 'success.php',
]);

// Return the Session ID as JSON
header('Content-Type: application/json');
echo json_encode(['sessionId' => $checkout_session->id]);
