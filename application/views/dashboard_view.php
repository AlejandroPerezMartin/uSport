
<div class="container main">

    <div class="page-header">
      <h1>Dashboard</h1>
  </div>

  <p>
    <div class="btn-group" role="group">
        <a class="btn btn-lg btn-primary" href="<?php echo base_url() . 'index.php/events/create'; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create event</a>
    </div>
    <div class="btn-group" role="group">
        <a class="btn btn-lg btn-default" href="<?php echo base_url() . 'index.php/events/create'; ?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search event</a>
    </div>
</p>

<br>

<?php if ($events): ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">My events</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php for ($i = 0; $i < count($events); $i++): ?>
                <?php if ($i == 3) break; ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/300x300" alt="asas">
                        <div class="caption">
                            <h3><?php echo $events[$i]->name; ?></h3>
                            <p><?php echo $events[$i]->description; ?></p>
                            <p><a href="<?php echo base_url() . 'index.php/events/view/id/' . $events[$i]->id; ?>" class="btn btn-primary" role="button">Info.</a>
                             <a href="<?php echo base_url() . 'index.php/events/remove/' . $events[$i]->id; ?>" class="btn btn-default" style="color:crimson;" role="button">Leave</a></p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<?php
else:
    echo "You don't have any event yet.";
endif;
?>

</div><!-- /.container -->
