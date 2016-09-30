<?php 
 
$animals = array("hamster", "unicorn", "monkey");



 if(isset($_POST['signIn'])) {
 	if (!(($_POST['captchaInput']) == $animals[$_POST['rand']])) {
 		   header ("Location: wrong_captcha.php");
 		 exit();
 	} 
 }


?>