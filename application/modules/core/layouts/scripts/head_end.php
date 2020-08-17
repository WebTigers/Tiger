<?php
/**
 * head_end.php
 *
 * Author: pixelcave
 *
 * (continue) The first block of code used in every page of the template
 *
 * The reason we separated head_start.php and head_end.php is for enabling
 * us to include between them extra plugin CSS files needed only in specific pages
 *
 */
?>

    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
    <link rel="stylesheet" id="css-main" href="<?php echo $this->one->assets_folder; ?>/css/oneui.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    <?php if ( isset($this->one->theme) ) { ?>
    <link rel="stylesheet" id="css-theme" href="<?php echo $this->one->assets_folder; ?>/css/themes/<?php echo $this->one->theme; ?>.min.css">
    <?php } ?>

    <!-- TIGER Layout -->
    <?php echo $this->headLink(); ?>
    <?php echo $this->headStyle(); ?>
    <?php echo $this->headScript(); ?>

    <!-- END Stylesheets -->
</head>
<body>
