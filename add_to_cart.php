<?php
    $item = $_GET["item"];
    if(isset($_COOKIE["items"])){
        $items = json_decode($_COOKIE["items"], true);
    }
    $items[$item]++;
    setcookie("items", json_encode($items), time()+3600, "/");
    header('Location: ' . 'index.php');
    die();
 ?>
