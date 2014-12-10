
<div class="container main">

<?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'form');
    echo form_open(base_url() . 'index.php/events/create', $attributes);
?>

<?php if (isset($message)) echo $message; ?>

<?php if (validation_errors()) echo '<div class="alert alert-danger" role="alert"><p><strong>Please correct the errors below:</strong></p>' . validation_errors() . '</div>' ?>

<fieldset>

    <legend><h2>Create event</h2></legend>

    <div class="form-group">
        <div class="col-xs-4">
            <label for="eventName">Name:</label>
            <input id="eventName" type="text" name="name" value="<?php echo set_value('name') ?>" placeholder="Name" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-6">
            <label for="eventDescription">Description:</label>
            <textarea id="eventDescription" name="description" placeholder="Event description" rows="8" class="form-control"><?php echo set_value('description') ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-6">
            <div class="input-group">
                <div class="input-group-addon">http://</div>
                <label class="sr-only" for="eventPhoto">Photo URL:</label>
                <input id="eventPhoto" type="text" name="photo" value="<?php echo set_value('photo') ?>" placeholder="Photo URL" class="form-control" />
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="col-xs-6">
            <label for="eventAddress">Address:</label>
            <input id="eventAddress" type="text" name="address" value="<?php echo set_value('address') ?>" placeholder="Address" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-4">
            <label for="eventCity">City:</label>
            <input id="eventCity" type="text" name="city" value="<?php echo set_value('city') ?>" placeholder="City" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <label for="eventSport">Sport:</label>
            <select name="sport" class="form-control" id="eventSport">
                    <option value="">-- Select sport --</option>
                    <option value="Football" <?php echo set_select('sport', 'Football'); ?> >Football</option>
                    <option value="Rugby" <?php echo set_select('sport', 'Rugby'); ?> >Rugby</option>
                    <option value="Basketball" <?php echo set_select('sport', 'Basketball'); ?> >Basketball</option>
                    <option value="Cycling" <?php echo set_select('sport', 'Cycling'); ?> >Cycling</option>
                    <option value="Tennis" <?php echo set_select('sport', 'Tennis'); ?> >Tennis</option>
                    <option value="Volleyball" <?php echo set_select('sport', 'Volleyball'); ?> >Volleyball</option>
                    <option value="Ski" <?php echo set_select('sport', 'Ski'); ?> >Ski</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-4">
            <label for="maxmembers">Max. number of members</label>
            <input type="number" name="maxmembers" id="maxmembers" value="<?php echo set_value('maxmembers') ?>" min="0" placeholder="0" class="form-control" />
            <p class="help-block">Maximum number of people that can join your event.</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <input type="submit" value="Create event" name="submit" class="btn btn-lg btn-success" />
        </div>
    </div>

</fieldset>

<?php echo form_close()?>
