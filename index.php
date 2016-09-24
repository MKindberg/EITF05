<?php

include "header.html";
include "db_interface.php"; 
include "mysql_login_data.php"; // unsafe to have login data here?

$database = new Database( $host,$userName, $password, $database);
$database->openConnection();


if(! $database->isConnected()) {
  header ("Location: db_not_connected.php");
  exit();
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
    <a href=\"#\"><button>Add to cart</button></a>
    </div>";
     
}
?>

<p>We use cookies!</p>

</body>
</html>
