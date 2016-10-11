<?php
include "header.php";
include "db_interface.php";
include "mysql_login_data.php";
$database = new Database( $host,$userName, $password, $database);
$database->openConnection();
$database->emptyCart();
header('Location: index.php');
die();
 ?>
