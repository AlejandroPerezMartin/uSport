<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="keywords" />
    <meta name="description" content="<?php if (isset($description)) echo $description; ?>" />
    <title><?php if (isset($title)) echo $title . ' &bull; '; ?>uSport</title>
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

    <?php if(!isset($dont_show_menu)): ?>
    <div class="navbar-wrapper">
        <div class="container">
            <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">uSport</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo $menu; ?>
                        </ul>
                    </div><!-- /#navbar -->
                </div><!-- /.container -->
            </nav>
        </div><!-- /.container -->
    </div><!-- /.navbar-wrapper -->
    <?php endif; ?>

    <div class="container">
