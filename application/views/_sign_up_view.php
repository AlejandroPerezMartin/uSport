
<?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open(base_url() . 'index.php/register/');
?>

<span><?php echo validation_errors() ?></span>

<fieldset>

    <legend>Create a uSport account!</legend>

    <input type="text" name="name" value="<?php echo set_value('name') ?>" />
    <input type="text" name="username" value="<?php echo set_value('username') ?>" />
    <input type="password" name="password" value="<?php echo set_value('password') ?>" />
    <input type="password" name="passconf" value="<?php echo set_value('passconf') ?>" />
    <input type="text" name="email" value="<?php echo set_value('email') ?>" />

    <select name="country">
        <option value="">Select Country</option>
        <option value="Spain" <?php echo set_select('country', 'Spain'); ?> >Spain</option>
        <option value="Spain" <?php echo set_select('country', 'Poland'); ?> >Poland</option>
        <option value="Spain" <?php echo set_select('country', 'France'); ?> >France</option>
        <option value="Spain" <?php echo set_select('country', 'United Kingdom'); ?> >United Kingdom</option>
        <option value="Spain" <?php echo set_select('country', 'Italy'); ?> >Italy</option>
        <option value="Spain" <?php echo set_select('country', 'Germany'); ?> >Germany</option>
    </select>

    <input type="radio" name="gender" value="Female"  <?php echo set_radio('gender', 'Male'); ?> /> Male &nbsp;&nbsp;   <input type="radio" name="gender" value="Male"  <?php echo set_radio('gender', 'Female'); ?> />   Female
    <input type="checkbox" name="terms" value="1" <?php echo set_checkbox('terms', '1'); ?> />I agree to Terms of Service and Privacy Policy
    <input type="submit" value="Submit" name="submit"/>

</fieldset>

<?php echo form_close()?>
