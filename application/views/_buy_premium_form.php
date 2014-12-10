<div class="container main">

    <?php
      $paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
      $paypal_id='usport@gmail.com';
    ?>

    <?php if (isset($message)) echo $message; ?>

    <div class="jumbotron">
        <h1>Become Premium!</h1>
        <p class="lead">Become a premium member today and start enjoying its <strong>benefits</strong>: unlimited event creation, unlimited event joining and more!</p>
        <p>
            <form action="<?php echo $paypal_url; ?>" method="POST" name="frmPayPal1">
                <div class="form-group">
                    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="item_name" value="uSport Premium Account">
                    <input type="hidden" name="userid" value="1">
                    <input type="hidden" name="amount" value="5">
                    <input type="hidden" name="cpp_header_image" value="<?php echo asset_url() . 'images/logo_1254610_web.jpg'; ?>">
                    <input type="hidden" name="no_shipping" value="1">
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="handling" value="0">
                    <input type="hidden" name="cancel_return" value="http://usport.no-ip.org/index.php/cancel">
                    <input type="submit" value="Pay with PayPal" name="submit" class="btn btn-lg btn-success"/>
                </div>
            </form>
        </p>
        <p>
            <h4>Only 5.00 &euro;</h4>
        </p>
    </div>

    <div class="row marketing">

      <div class="page-header">
        <h2>Premium features <small>What you'll get</small></h2>
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
