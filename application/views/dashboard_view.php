
<div class="container main">

    <div class="page-header">
        <h1>Dashboard</h1>
    </div>

    <?php if (isset($message)) echo $message; ?>
    <p>
        <div class="btn-group" role="group">
            <a class="btn btn-lg btn-primary" href="<?php echo base_url() . 'index.php/events/create'; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create event</a>
        </div>
        <div class="btn-group" role="group">
            <a class="btn btn-lg btn-default" href="<?php echo base_url() . 'index.php/events/create'; ?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search event</a>
        </div>
    </p>

<br>

<?php if ($joined_events): ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">My joined events</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php for ($i = 0; $i < count($joined_events); $i++): ?>
                <?php if ($i == 3) break; ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/300x300" alt="<?php echo $joined_events[$i]->name; ?>">
                        <div class="caption">
                            <h3><a href="<?php echo base_url() . 'index.php/events/view/id/' . $joined_events[$i]->id; ?>"><?php echo $joined_events[$i]->name; ?></a></h3>
                            <p><?php echo $joined_events[$i]->description; ?></p>
                            <p>
                              <a href="<?php echo base_url() . 'index.php/events/view/id/' . $joined_events[$i]->id; ?>" class="btn btn-primary" role="button">View</a>
                              <a href="<?php echo base_url() . 'index.php/events/unjoin/' . $joined_events[$i]->id; ?>" class="btn btn-default" style="color:crimson;" role="button" onclick="return unjoinFromEventConfirmation();">Unjoin</a>
                            </p>
                         </div>
                       </div>
                   </div>
               <?php endfor; ?>
           </div>
       </div>
   </div>

   <?php
   else:
    echo '<h4 class="text-center">You haven\'t joined any event yet</h4>';
endif;
?>

<br>

<?php if ($created_events): ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">My created events</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php for ($i = 0; $i < count($created_events); $i++): ?>
                <?php if ($i == 3) break; ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/300x300" alt="<?php echo $created_events[$i]->name; ?>">
                        <div class="caption">
                            <h3><a href="<?php echo base_url() . 'index.php/events/view/id/' . $created_events[$i]->id; ?>"><?php echo $created_events[$i]->name; ?></a></h3>
                            <p><?php echo $created_events[$i]->description; ?></p>
                            <p><a href="<?php echo base_url() . 'index.php/events/view/id/' . $created_events[$i]->id; ?>" class="btn btn-primary" role="button">View</a>
                               <a href="<?php echo base_url() . 'index.php/events/remove/' . $created_events[$i]->id; ?>" class="btn btn-default" style="color:crimson;" role="button" onclick="return deleteEventConfirmation();">Delete</a></p>
                           </div>
                       </div>
                   </div>
               <?php endfor; ?>
           </div>
       </div>
   </div>

   <?php
   else:
    echo '<h4 class="text-center">You haven\'t created any event yet</h4>';
endif;
?>
