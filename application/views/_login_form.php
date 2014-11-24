
<?php
    $attributes = array('class' => 'form-signin', 'role' => 'form');
    echo form_open(base_url().'index.php/login/', $attributes);
?>

<h2 class="form-signin-heading">uSport · Log in</h2>

<?php echo validation_errors(); ?>

<?php if(!empty($login_failed)) echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ' . $login_failed . '</div>'; ?>

<label for="email" class="sr-only">Email:</label>
<input type="email" id="email" class="form-control" placeholder="email" name="email" value="<?php echo set_value('email'); ?>" required autofocus>
<label for="password" class="sr-only">Password:</label>
<input type="password" id="password" class="form-control" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" required>
<div class="checkbox">
    <label>
        <input type="checkbox" value="remember-me"> Remember me
    </label>
</div>
<input type="submit" name="submit_login" class="btn btn-lg btn-primary btn-block" value="Sign in" />

<?php echo form_close()?>
