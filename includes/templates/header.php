<?php
$lan = 'en';
$dir = 'ltr';
if (isset($_SESSION['lang'])) {
    if ($_SESSION['lang'] == "en") {
        $lan = 'en';
        $dir = 'ltr';
    } elseif ($_SESSION['lang'] == "ar") {
        $lan = 'ar';
        $dir = 'rtl';
    }
}
?>
<html lang="<?php echo $lan ?>">
<head>
    <meta charset="UTF-8">
    <title><?php getTitle() ?></title>
    <link rel="icon" type="image/png" href="layout/images/looo.png">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>backend.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>login.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>index.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>item.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>cart.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>navbar.css"/>
</head>
<!--Open the body here and close it in the footer php file-->
<body id="body" style="direction: <?php echo $dir;?>">
