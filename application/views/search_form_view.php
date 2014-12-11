
<div class="container main">

<?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'form');
    echo form_open(base_url() . 'index.php/search/', $attributes);
?>

<?php if (isset($message)) echo $message; ?>

<?php if (validation_errors()) echo '<div class="alert alert-danger" role="alert"><p><strong>Please correct the errors below:</strong></p>' . validation_errors() . '</div>' ?>

<fieldset>

    <legend><h2>Search</h2></legend>

    <?php if (isset($cities)): ?>
    <div class="form-group">
        <div class="col-xs-2">
            <label for="searchcity">By city:</label>
            <select id="searchcity" class="form-control" name="searchcity">
                    <option value="">-- Select city --</option>
                    <?php foreach ($cities as $city):
                        echo '<option value="' . $city->city . '"' . set_select('searchcity', $city->city) . '>' . $city->city . '</option>';
                    endforeach; ?>
            </select>
        </div>
    </div>
    <?php endif ?>

    <div class="form-group">
        <div class="col-xs-4">
            <label>By sports:</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="searchsport[]" value="Football" id="football"> Football
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="searchsport[]" value="Rugby" id="rugby"> Rugby
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="searchsport[]" value="Basketball" id="basketball"> Basketball
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="searchsport[]" value="Cycling" id="cycling"> Cycling
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="searchsport[]" value="Tennis" id="tennis"> Tennis
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="searchsport[]" value="Volleyball" id="volleyball"> Volleyball
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="searchsport[]" value="Ski" id="ski"> Ski
                    </label>
                </div>
        </div>
    </div>

    <div class="form-group">
        <input type="submit" value="Search" name="submit" class="btn btn-lg btn-primary"/>
    </div>

</fieldset>

<?php echo form_close()?>
