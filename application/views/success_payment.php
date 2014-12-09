<div class="container main">

    <?php if($success): ?>
        <div class="page-header">
            <h1>Payment Successful</h1>
        </div>
        <div class="alert alert-success" role="alert"><p>Thank you for your payment.</p></div>
        <p>Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at www.paypal.com to view details of this transaction</p>
    <?php else: ?>
        <div class="page-header">Payment failed</div>
        <p>Sorry, there was a problem processing your payment. Please contact administrator to solve the issue.</p>
    <?php endif; ?>

</div>
