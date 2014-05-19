<?php global $is_mobile ?>
<?php $is_mobile = isset($_GET['mobile']) ?>
<!DOCTYPE html>
<html lang="fr" class="utf8">
<head>
    <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>

    <meta name="description" content=""/>

    <meta property="og:title" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:site_name" content=""/>

    <title>World's Best Bars</title>

    <link rel="stylesheet" media="screen" href="stylesheets/front.css"/>

    <!-–[if lt IE 9]>
    <script src="js/plugins/html5.js"></script>
    <![endif]–->

    <script type="text/javascript" src="js/plugins/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.easing.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.velocity.min.js"></script>

    <script type="text/javascript" src="js/libs/utils.metabolism.js"></script>
    <script type="text/javascript" src="js/libs/slider.metabolism.js"></script>
    <script type="text/javascript" src="js/libs/ratio.metabolism.js"></script>

    <script type="text/javascript" src="js/app.js"></script>

    <script type="text/javascript">
        var MARKET  = "FR";
        var LANG    = "fr";
        //var BASEURL = "/pr0d/wbb/";
        var BASEURL = "/Pr0d/World%20Best%20Bar/Web/";
        var TRAD    = {};
    </script>

</head>

<body class="<?=$page?>">

    <?php if( $is_mobile ): ?>

        <?php include('includes/mobile/header.php') ?>

    <?php else: ?>

        <?php include('includes/header.php') ?>

    <?php endif ?>
