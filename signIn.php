<?php
include "header.php";
include "db_interface.php";
include "mysql_login_data.php";

if(isset($_SESSION["loggedIn"])){
    header('Location: ' . 'index.php');
   die();
}
    if(isset($_POST['signIn'])) {

      //check all fields filled
      $database = new Database( $host,$userName, $password, $database);
      $msg = $database->signIn();

      echo $msg;
      if(isset($_SESSION["loggedIn"])){
          header('Location: ' . 'index.php');
          die();
 }
    }
?>


<!DOCTYPE html>
<html>
<head>
<title>Webshop - Sign in</title>
</head>
<body>
  <h1>Sign in!</h1>
  <form name="signIn" method="post" action="signIn.php">
    Username:<br>
    <input type="text" name="username"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit" value="Sign in" name="signIn">
  </form>
</body>
</html>
