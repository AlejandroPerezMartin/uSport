<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="keywords" />
    <meta name="description" content="<?php (isset($description)) ? $description : ''; ?>" />
    <title><?php echo $title; ?> &bull; uSport</title>
    <link rel="stylesheet" href="<?php echo asset_url() . 'css/bootstrap.min.css'; ?>">
    <?php if (isset($styles)): foreach ($styles as $style_name): ?>
    <link rel="stylesheet" href="<?php echo asset_url() . 'css/' . $style_name . '.css'; ?>">
    <?php endforeach; endif; ?>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
