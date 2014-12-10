<div class="container main">

    <?php if($success): ?>

        <div class="alert alert-success" role="alert">
            <p><strong>Thank you for your payment!</strong> Your transaction has been completed, and a receipt for your purchase has been emailed to you.</p>
            <p>To view more details about this transaction please log in to your <a href="https://paypal.com" title="Go to PayPal.com">PayPal account</a>.</p>
        </div>

        <div class="jumbotron">
            <h1>You're Premium!</h1>
            <p class="lead"><strong>Congratulations!</strong> Now you are a premium member and you can take advantage of all its features!</p>
            <p><a href="<?php echo base_url(); ?>" value="Go to your dashboard" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Go to your dashboard</a></p>
        </div>

        <div class="row marketing">

          <div class="page-header">
            <h2>What you just got! <small>Premium features</small></h2>
          </div>

          <div class="col-lg-6">
              <h4><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Unlimited events creation</h4>
              <p>Get rid of the event creation restriction, create as much events as you want!</p>

              <h4><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Unlimited events joining</h4>
              <p>Join as many events as you want! There is no limit!</p>
          </div>

          <div class="col-lg-6">
              <h4><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Featured events</h4>
              <p>Your event will be listed at the top of the events to make it more visible!</p>

              <h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Lifetime premium membership</h4>
              <p>Pay only once and you get a lifetime premium membership!</p>
          </div>
        </div>

    <?php else: ?>

        <div class="page-header">Payment failed</div>
        <p>Sorry, there was a problem processing your payment. Please contact administrator to solve the issue.</p>

    <?php endif; ?>
