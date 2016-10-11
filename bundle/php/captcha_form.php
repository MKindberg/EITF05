<?php 

$captcha_nbr = 1;

?>

<!DOCTYPE html>
<html>
<head>
<title>Webshop EITF05 project</title>
</head>
<body>

<img src="captcha_images/<?php echo $captcha_nbr ?>.jpg"  height="100" width="100" />

  <form name="captcha" method="post" action="check_captcha.php">
    Type what you see!<br>
    <input type="text" name="captchaInput"><br>
    <input type="submit" value="Check" name="checkCaptcha">
  </form>

	</body>

	</html>