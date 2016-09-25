<?php
    include "db_interface.php";
    include "mysql_login_data.php";
    $database = new Database( $host,$userName, $password, $database);
    $database->signOut();
    header('Location: ' . 'index.php');
    die();
?>
