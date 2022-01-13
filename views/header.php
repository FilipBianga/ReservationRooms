<!DOCTYPE html>
<html>
<head>
    <title>Reservation</title>
    <link rel="stylesheet" href="<?php echo URL;?>public/css/style.css" />
    <link rel="stylesheet" href="<?php echo URL;?>public/css/jquery-ui.css">
    <script src="<?php echo URL;?>public/js/jquery-1.10.2.js"></script>
    <script src="<?php echo URL;?>public/js/jquery-ui.js"></script>
    <meta charset="UTF-8">
</head>
<body>
    <?php Session::init(); ?>
    <div id="header">
        HEADER
        <br>
        <a href="<?php echo URL;?>index">Index</a>
        <a href="<?php echo URL;?>help">Help</a>
        <?php if (Session::get('loggedIn') == true):?>
            <a href="<?php echo URL;?>dashboard/logout">Logout</a>
        <?php else: ?>
            <a href="<?php echo URL;?>admin">Admin</a>
        <?php endif; ?>
    </div>
<div id="content">