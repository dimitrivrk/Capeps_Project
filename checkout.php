<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Procédez au paiement de vos fiches CAPEPS 2025 en toute sécurité.">
    <title>Paiement | Fiches CAPEPS 2025</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Paiement</h1>
    <div id="cart-details"></div>
    <form action="charge.php" method="post" id="payment-form">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>
        <button type="submit">Payer</button>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            renderCartDetails();
        });
    </script>
</body>
</html>
