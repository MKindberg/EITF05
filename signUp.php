<?php

include "header.php";
include "db_interface.php";
include "mysql_login_data.php";

    if(isset($_POST['register'])) {

      //check all fields filled
      $database = new Database( $host,$userName, $password, $database);
      $msg = $database->signUp();

      header('Location: ' . 'index.php');
      die();
    }

?>

<html>
<head>
<title>Webshop - Sign up</title>
</head>
<body>
  <h3>Sign up!</h3>

  <form name="registration" method="post" action="signUp.php">
  Username * </br>
  <input type="text" name="regName" value=""></br>
  Adress *</br>
  <input type="text" name="regAdress" value=""></br>
  Password *</br>
  <input type="password" name="regPassword" value=""></br>
  Re-enter  Password *</br>
  <input type="password" name="regRepassword" value=""></br>
  <input type="submit" value="Sign up" name="register">
  </form>
  <p class="small-text">(* = required) </p>





</body>
</html>
