<?php

include "header.php";
include "db_interface.php";
include "mysql_login_data.php";
include "token_check.php";

$items = json_decode($_COOKIE["items"], true);

/*
echo $row[0]; // productId
echo $row[1]; // name
echo $row[2]; // desc
echo $row[3]; // price
echo $row[4]; //color
*/
$database = new Database( $host,$userName, $password, $database);
$database->openConnection();
echo "Payment successfully complete!\nYou have bought:";
foreach ($items as $colorID => $nbr) {
  $col = $database->getItem($colorID);
  $item = $col[0];
  echo "<p>$nbr of the color $item[1]</p>";
  for ($i=0; $i < $nbr; $i++) {
    echo "<div style=\"background-color:$item[4]; height: 15px; width: 30px; display: inline-block;\"></div>";
  }
}
$database->emptyCart();
$database->closeConnection();

?>
<!DOCTYPE html>
<html>
<head>
<title>Webshop EITF05 project</title>

</head>
<body>
