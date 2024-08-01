<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Security-Policy: default-src 'self'; script-src 'self' https://js.stripe.com; style-src 'self'");

require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51PQWT6RvBURxGjZokRI6yu3WaxIKCK98HOKAkseLFnH6qrE5Qog7r7pEVs0GGN4FhcW8CORMbJyyjPz9wewHW0fU001sSIzXW9');

if (isset($_POST['stripeToken'], $_POST['email'], $_POST['cart'])) {
    $token = htmlspecialchars($_POST['stripeToken']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $cart = json_decode($_POST['cart'], true);

    if ($email && $cart) {
        $amount = array_reduce($cart, function($total, $item) {
            return $total + $item['price'];
        }, 0) * 100;

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'description' => 'Achat de fiches CAPEPS',
                'source' => $token,
                'receipt_email' => $email
            ]);

            require 'mail.php';

            // header('Location: payment_success.php');
            exit();
        } catch (\Stripe\Exception\CardException $e) {
            error_log('Stripe CardException: ' . $e->getMessage());
            // header('Location: payment_failed.php');
            exit();
        } catch (\Exception $e) {
            error_log('Exception: ' . $e->getMessage());
            // header('Location: payment_failed.php');
            exit();
        }
    } else {
        error_log('Invalid email or empty cart');
        // header('Location: payment_failed.php');
        exit();
    }
} else {
    error_log('Missing required input');
    // header('Location: payment_failed.php');
    exit();
}
?>
