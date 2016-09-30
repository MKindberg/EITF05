<?php

include "header.php";
include "db_interface.php";
include "token_check.php";



?>


<html>
<head>
<title>Webshop - Checkout</title>
</head>
<body>
  <h3>Checkout</h3>

  <form name="checkout" method="post" action="paymentcomplete.php">

  Name on credit card </br>
  <input type="text" name="cardName" value=""></br>

  Card Type</br>
  <select name="cardtype">
    <option value="visa">VISA</option>
    <option value="mastercard">Mastercard</option>
    <option value="maestro">Maestro</option>
    <option value="amex">American Express</option>
  </select> </br>
  Card number </br>
  <input type="text" name="cardNumber" value="" maxlength="16"></br>

  Expiration date</br>
  <input type="text" name="cardExpDate" value=""></br>

  Security Code (CVD)</br>
  <input type="text" name="cardCVD" value="" maxlength="3"></br>

  <input type="submit" value="confirm" name="payment">

  <input type="hidden" name="token" value="<?php echo $token; ?>" />
  </form>





</body>
</html>
