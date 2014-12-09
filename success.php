<?php

$item_no            = $_REQUEST['item_number'];
$item_transaction   = $_REQUEST['tx']; // Paypal transaction ID
$item_price         = $_REQUEST['amt']; // Paypal received amount
$item_currency      = $_REQUEST['cc']; // Paypal received currency type

$price = 5;
$currency='EUR';

//Rechecking the product price and currency details
if( $item_price == $price && $item_currency == $currency )
{
    echo "<h1>Payment Successful</h1>";
    echo "<p>Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at www.paypal.com to view details of this transaction.</p>";
}
else
{
    echo "<h1>Payment Failed</h1>";
}

?>
