
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo asset_url() . 'js/bootstrap.min.js' ?>"></script>
<?php if(isset($scripts)): foreach ($scripts as $script_name): ?>
<script src="<?php echo asset_url() . 'js/' . $script_name . '.js' ?>"></script>
<?php endforeach; endif; ?>

</body>
</html>
