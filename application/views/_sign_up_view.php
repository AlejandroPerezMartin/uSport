<div>
<div> Join now, please fill in the form below</div>


<?php echo form_open(base_url()."index.php/register/")?>
<span><?php echo validation_errors() ?></span>
<div>
<div>Your Name: </div>
<div>
<input type="text" name="name" value="<?php echo set_value('name') ?>" />
</div>
</div>
<div>
<div>Your Username</div>

<div>
<input type="text" name="username" value="<?php echo set_value('username') ?>" />
</div>
</div>

<div>
<div>Your Password</div>
<div>
<input type="password" name="password" value="<?php echo set_value('password') ?>" />
</div>
</div>

<div>
<div>Confirm Your Password</div>
<div>
<input type="password" name="passconf" value="<?php echo set_value('passconf') ?>" />
</div>
</div>
<div>
<div>Your Email</div>
<div>
<input type="text" name="email" value="<?php echo set_value('email') ?>" />
</div>
</div>
<div>
<div>Country</div>

<select name="country">
<option value="">Select Country</option>
<option value="Spain" <?php echo set_select('country', 'Spain'); ?> >Spain</option>
<option value="Spain" <?php echo set_select('country', 'Poland'); ?> >Poland</option>
<option value="Spain" <?php echo set_select('country', 'France'); ?> >France</option>
<option value="Spain" <?php echo set_select('country', 'United Kingdom'); ?> >United Kingdom</option>
<option value="Spain" <?php echo set_select('country', 'Italy'); ?> >Italy</option>
<option value="Spain" <?php echo set_select('country', 'Germany'); ?> >Germany</option>

</select>

</div>

<div>
<div>Your Gender</div>

<input type="radio" name="gender" value="Female"  <?php echo set_radio('gender', 'Male'); ?> /> Male &nbsp;&nbsp;   <input type="radio" name="gender" value="Male"  <?php echo set_radio('gender', 'Female'); ?> />   Female

</div>

<div >
<input type="checkbox" name="terms" value="1" <?php echo set_checkbox('terms', '1'); ?> />I agree to Terms of Service and Privacy Policy
</div>
<div><input type="submit" value="Submit" name="submit"/></div>

</div>
<?php echo form_close()?>
</body>
</html>
