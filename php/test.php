<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/payement.js" defer></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AfNE3JJ7EtwG46wj6LKUtZN_5ZJxLktEDgUoy_aNZzYP_p_ntfLrgWi5NcNI7ADu1BvVKahVVfJ3MFpF"></script>
</head>
<body>

<div id="paypal-boutons"></div>

</body>
</html>

<script>
    paypal.Buttons({

// Configurer la transaction
createOrder : function (data, actions) {

    // Les produits à payer avec leurs details
    var produits = [
        {
            name : "Produit 1",
            description : "Description du produit 1",
            quantity : 1,
            unit_amount : { value : 9.9, currency_code : "USD" }
        },
        {
            name : "Produit 2",
            description : "Description du produit 2",
            quantity : 1,
            unit_amount : { value : 8.0, currency_code : "USD" }
        }
    ];

    // Le total des produits
    var total_amount = produits.reduce(function (total, product) {
        return total + product.unit_amount.value * product.quantity;
    }, 0);

    // La transaction
    return actions.order.create({
        purchase_units : [{
            items : produits,
            amount : {
                value : total_amount,
                currency_code : "USD",
                breakdown : {
                    item_total : { value : total_amount, currency_code : "USD" }
                }
            }
        }]
    });
}

}).render("#paypal-boutons");
</script>