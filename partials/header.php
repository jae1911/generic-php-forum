<!DOCTYPE html>
<html lang="en">
<?php
    $start_page_load = microtime(true);
    session_start();
    require('util/db.php');

    $logged_in = false;
    if(isset($_SESSION['sess_userid'])) {
        $logged_in = true;
    }
?>
<head>
    <meta charset="utf-8">
    <title>My Cool Forum<?php if (isset($_TITLE)) print(" - $_TITLE"); ?></title>
</head>

<body>
