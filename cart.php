<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Consultez votre panier et passez à la caisse pour acheter vos fiches CAPEPS 2025.">
    <title>Panier | Fiches CAPEPS 2025</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Votre Panier</h1>
    <div id="cart">
        <!-- Le contenu du panier sera injecté ici -->
    </div>
    <button onclick="clearCart()">Vider le panier</button>
    <a href="checkout.php">Passer à la caisse</a>
    <script src="app.js"></script>
</body>
</html>
