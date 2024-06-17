<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51PQWT6RvBURxGjZokRI6yu3WaxIKCK98HOKAkseLFnH6qrE5Qog7r7pEVs0GGN4FhcW8CORMbJyyjPz9wewHW0fU001sSIzXW9');


$response = ["payment" => "error", "amount" => 0];

if(isset($_POST['stripeToken'], $_POST['amount'],$_POST['first-name'], $_POST['last-name'])){
    $token = $_POST['stripeToken'];
    $amount = $_POST['amount'];
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    
    $amount = $amount * 100;
    try{
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'eur',
            'description' => 'Example charge',
            'source' => $token,
            'metadata' => [
                'first_name' => $first_name,
                'last_name' => $last_name
            ]]);

            echo 'Success! Your payment has been accepted.'; 
 

        }catch(\Stripe\Exception\CardException $e){
            $response['message'] = $e->getMessage();
        }catch(\Exception $e){
            $response['message'] = $e->getMessage();
        
    }
}

echo json_encode($response);

?>
