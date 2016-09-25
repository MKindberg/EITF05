<?php
    $item = $_GET["item"];
    array_push($_COOKIE["items"], $item);
    $_COOKIE[$item]++;
    header('Location: ' . 'index.php');
    die();
 ?>
