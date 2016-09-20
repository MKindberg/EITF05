<?php

include "header.html";
include "db_interface.php";
  if(isset($_REQUEST['submit'])!=''){
    if($_REQUEST['name']=='' || $_REQUEST['adress']=='' || $_REQUEST['password']==''|| $_REQUEST['repassword']=='')
    {
      Echo "please fill the empty field.";
    }
    else{
      $sql="insert into users(name,password,adress) values('".$_REQUEST['name']."', '".$_REQUEST['password']."', '".$_REQUEST['adress']."')";
      $res=mysql_query($sql);
      if($res){
        Echo "Record successfully inserted";
      }
      else{
        Echo "There is some problem in inserting record";
      }
    }
  }

?>

<html>
<head>
<title>Webshop - Sign up</title>
</head>
<body>
  <h1>Sign up!</h1>

  <form name="registration" method="post" action="signUp.php">
  USERNAME:</br>
  <input type="text" name="name" value=""></br>
  ADRESS:</br>
  <input type="text" name="adress" value=""></br>
  PASSWORD:</br>
  <input type="text" name="password" value=""></br>
  RE-Enter  PASSWORD:</br>
  <input type="text" name="repassword" value=""></br>
  <input type="submit" name="submit" value="submit">
  </form>





</body>
</html>
