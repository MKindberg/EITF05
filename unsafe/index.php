<?php

include "header.php";
include "db_interface.php";
include "mysql_login_data.php"; // unsafe to have login data here?

$database = new Database( $host,$userName, $password, $database);
$database->openConnection();


if(! $database->isConnected()) {
  header ("Location: db_not_connected.php");
  exit();
}

if(isset($_GET['newColor'])) {

  //check all fields filled
  $msg = $database->addColor();

  echo $msg;
}

//connection successfull

$result = $database->getAllProducts();

?>


<!DOCTYPE html>
<html>
<head>
<title>Webshop EITF05 project</title>
</head>
<body>

<h1>Products</h1>
<div class="product_container"></div>

<?php
foreach ( $result as $row ) {

    /*
    echo $row[0]; // productId
    echo $row[1]; // name
    echo $row[2]; // desc
    echo $row[3]; // price
    echo $row[4]; //color
    */

echo "
    <div class=\"product-div\">
        <div class=\"color-image\" style=\"background-color:$row[4]\"></div>
        <p class=\"product-name\">$row[1]<p>
        <p class=\"product-desc\">$row[2]</p>
        <p class=\"product-price\">Price: $row[3]</p>
	<p class=\"product-user\">Uploaded by: $row[5]</p>
        <form action=\"add_to_cart.php\" method=\"get\">
            <input type=\"hidden\" name=\"item\" value=$row[0]>
            <input type=\"submit\" value=\"Add to cart\">
        </form>
    </div>";

}

if(isset($_SESSION['loggedIn'])){
echo '<form name="newColor" method="get" action="index.php">
Name * </br>
<input type="text" name="colName" value=""></br>
Description *</br>
<input type="text" name="colDesc" value=""></br>
Price *</br>
<input type="text" name="colPrice" value=""></br>
Color code *</br>
<input type="text" name="colCode" value=""></br>
<input type="submit" value="Submit" name="newColor">
</form>';
}
?>


<p style="vertical-align : bottom;">We use cookies!</p>

</body>
</html>
