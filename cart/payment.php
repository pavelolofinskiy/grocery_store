<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

$stripe_key = 'sk_test_51PfhPQL63PU2FQohebszctT9kAyCDbjVf3dfkDRtkkywXOsWE3I5q2EAZUS3gzR0GppXhaglWXFiwTvaI0NEyQtA00eG9H0R6f';

$totalPrice = $_GET['totalPrice'] ?? 0;
$totalPriceCents = $totalPrice * 100;


\Stripe\Stripe::setApiKey($stripe_key);

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/success.php",
        "cancel_url" => "http://localhost:3000/main/index.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => $totalPriceCents,
                    "product_data" => [
                        "name" => "Groceries"
                    ]
                ]
            ],
        ]
    ]);

    // Redirect to the Stripe Checkout page
    header("Location: " . $checkout_session->url);
    exit();

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
<script>

    alert($totalPrice);
</script>