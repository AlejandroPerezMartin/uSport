
<div class="container main">

<?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'form');
    echo form_open(base_url() . 'index.php/register/', $attributes);
?>

<?php if (isset($message)) echo $message; ?>

<?php if (validation_errors()) echo '<div class="alert alert-danger" role="alert"><p><strong>Please correct the errors below:</strong></p>' . validation_errors() . '</div>' ?>

<fieldset>

    <legend><h2>Create a uSport account!</h2></legend>

    <div class="form-group">
        <div class="col-xs-3">
            <label for="registerName">Name:</label>
            <input id="registerName" type="text" name="name" value="<?php echo set_value('name') ?>" placeholder="Name" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-4">
            <label for="registerSurname">Surname:</label>
            <input id="registerSurname" type="text" name="surname" value="<?php echo set_value('surname') ?>" placeholder="Surname" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <label for="registerEmail">Email:</label>
            <input id="registerEmail" type="email" name="email" value="<?php echo set_value('email') ?>" placeholder="Email" class="form-control" />
        </div>
    </div>


    <div class="form-group">
        <div class="col-xs-2">
            <label for="registerBirthdate">Date of birth:</label>
            <input id="registerBirthdate" type="text" name="birthdate" value="<?php echo set_value('birthdate') ?>" class="form-control" placeholder="DD/MM/YYYY" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-4">
            <label for="registerCity">City:</label>
            <input id="registerCity" type="text" name="city" value="<?php echo set_value('city') ?>" placeholder="City" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-2">
            <label for="registerCountry">Country:</label>
            <select id="registerCountry" class="form-control" name="country">
                    <option value="">-- Select Country --</option>
                    <option value="Spain" <?php echo set_select('country', 'Spain'); ?> >Spain</option>
                    <option value="Poland" <?php echo set_select('country', 'Poland'); ?> >Poland</option>
                    <option value="France" <?php echo set_select('country', 'France'); ?> >France</option>
                    <option value="United Kingdom" <?php echo set_select('country', 'United Kingdom'); ?> >United Kingdom</option>
                    <option value="Italy" <?php echo set_select('country', 'Italy'); ?> >Italy</option>
                    <option value="Germany" <?php echo set_select('country', 'Germany'); ?> >Germany</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-4">
            <label>Favourite sports:</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="favouritesport" value="Football" id="football"> Football
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="favouritesport" value="Rugby" id="rugby"> Rugby
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="favouritesport" value="Basketball" id="basketball"> Basketball
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="favouritesport" value="Cycling" id="cycling"> Cycling
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="favouritesport" value="Tennis" id="tennis"> Tennis
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="favouritesport" value="Volleyball" id="volleyball"> Volleyball
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="favouritesport" value="Ski" id="ski"> Ski
                    </label>
                </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <label for="registerPassword">Password:</label>
            <input id="registerPassword" type="password" name="password" value="<?php echo set_value('password') ?>" placeholder="Password" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <label for="registerPasswordConfirm">Confirm password:</label>
            <input id="registerPasswordConfirm" type="password" name="passconf" value="<?php echo set_value('passconf') ?>" placeholder="Confirm password" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-4">
            <label>Gender:</label>
            <div class="radio">
                <label>
                    <input type="radio" name="gender" value="Male" id="gendermale" <?php echo set_radio('gender', 'Male'); ?> /> Male
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="gender" value="Female" id="genderfemale" <?php echo set_radio('gender', 'Female'); ?> /> Female
                </label>
            </div>
        </div>
    </div>

    <label for="agreeTerms">Terms of Service:</label>
    <div class="form-group">
        <div class="col-xs-4">
            <div class="checkbox">
                <label>
                    <input id="agreeTerms" type="checkbox" name="terms" value="1" <?php echo set_checkbox('terms', '1'); ?> /> I agree to Terms of Service and Privacy Policy
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <input type="submit" value="Create account" name="submit" class="btn btn-lg btn-success"/>
    </div>

</fieldset>

<?php echo form_close()?>

</div><!-- /.container -->
