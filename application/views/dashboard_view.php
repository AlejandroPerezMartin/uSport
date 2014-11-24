
<div class="container main">

<a href="<?php echo base_url() . 'index.php/events/create'; ?>" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create event</a>

<?php

if ($events)
{
    foreach ($events as $event) {
        echo $event->name . '<br>';
        echo $event->sport . '<br>';
    }
}
else{
    echo "You don't have any event yet.";
}

?>

</div><!-- /.container -->
