<div>
<?php echo form_open(base_url().'index.php/login/')?>
<div>Login to your account</div>
<?php echo validation_errors(); ?>
<span><b><?php echo $login_failed; ?></b></span>

<div>
<div>Username Or Email: </div>
<div>
<input type="text" name="username" value="<?php echo set_value('username'); ?>"/>

</div>
</div>

<div>
<div>Password: </div>
<div>

<input type="password" name="password" value="<?php echo set_value('password'); ?>" /><br/>
</div>
</div>

<div>
<input type="submit" value="Submit" name="submit_login"/>
</div>

<?php echo form_close()?>
</div>
