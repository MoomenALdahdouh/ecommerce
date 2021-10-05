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
    <link rel="stylesheet" href="<?php echo $cssm; ?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $cssm; ?>backend.css"/>
    <link rel="stylesheet" href="<?php echo $cssm; ?>login.css"/>
    <link rel="stylesheet" href="<?php echo $cssm; ?>index.css"/>
    <link rel="stylesheet" href="<?php echo $cssm; ?>item.css"/>
    <link rel="stylesheet" href="<?php echo $cssm; ?>cart.css"/>
    <link rel="stylesheet" href="<?php echo $cssm; ?>order.css"/>
    <link rel="stylesheet" href="<?php echo $cssm; ?>navbar.css"/>
</head>
<!--Open the body here and close it in the footer php file-->
<body id="body" style="direction: <?php echo $dir;?>">
