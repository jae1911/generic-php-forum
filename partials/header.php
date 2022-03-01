<!DOCTYPE html>
<html lang="en">
<?php
    $start_page_load = microtime(true);
    session_start();
    require('util/db.php');
?>
<head>
    <meta charset="utf-8">
    <title>My Cool Forum<?php if (isset($_TITLE)) print(" - $_TITLE"); ?></title>
</head>

<body>
