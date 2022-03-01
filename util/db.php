<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_pw = '';
    $db_name = 'forum';

    $db_connection_string = "mysql:host=$db_host;dbname=$db_name";

    try {
        $db = new PDO($db_connection_string, $db_user, $db_pw);
    } catch(PDOException $e) {
        print($e->getCode());
        die();
    }

?>
