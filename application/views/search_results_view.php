
<div class="container main">

<?php if (isset($message)) var_dump($message); ?>

<?php if (isset($results)): ?>

    <div class="page-header">
        <h2>Search results</h2>
    </div>

    <div class="panel-body">
        <div class="row">
            <?php for ($i = 0; $i < count($results); $i++): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/300x300" alt="<?php echo $results[$i]->name; ?>">
                        <div class="caption">
                            <h3><a href="<?php echo base_url() . 'index.php/events/view/id/' . $results[$i]->id; ?>"><?php echo $results[$i]->name; ?></a></h3>
                            <p><?php echo $results[$i]->description; ?></p>
                            <p>
                              <a href="<?php echo base_url() . 'index.php/events/view/id/' . $results[$i]->id; ?>" class="btn btn-primary" role="button">View</a>
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
    echo '<h4 class="text-center">Sorry, there are no events matching your criteria.</h4>';
endif;
?>
