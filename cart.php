<?php

include "header.php";
include "db_interface.php";
include "mysql_login_data.php";
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
$toPay = 0;
echo "In cart: \n";
foreach ($items as $colorID => $nbr) {
  $col = $database->getItem($colorID);
  $item = $col[0];
  echo "<p>$nbr of the color $item[1] for a total of ". ($nbr*$item[3]) ."</p>";
  $toPay+=$nbr*$item[3];
}
echo "\nTotal: $toPay \n";
$database->closeConnection();

if(isset($_SESSION["loggedIn"]))
  echo "<a href=\".\checkout.php\"><button>Go to payment</button></a>";
else
  echo "<p>You have to <a href=\".\signIn.php\">sign in</a> to buy.</p>";

?>
