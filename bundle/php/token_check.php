<?php



if (isset($_REQUEST['token'])) {

if (! ($_REQUEST['token'] == $_SESSION['token']) ) {
  echo "Form was tampered with.. <br> Back home <a href='index.php'>Home</a>";
  exit();
}

unset($_REQUEST['token']);
unset($_SESSION['token']);

}
?>