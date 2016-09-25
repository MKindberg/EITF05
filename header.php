<!DOCTYPE html>
<?php
    if(isset($_COOKIE["logged in"])){
        $signInOut = "Sign out";
        $account = "Account";
    }
    else{
        $signInOut = "Sign in";
        $account = "Sign up";
    }
 ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="header.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="navbar">
        <p><a href="index.php">Colors</a></p>
        <ul>
            <li><a href="signIn.php"><?php echo $signInOut ?></a></li>
            <li><a href="signUp.php"><?php echo $account ?></a></li>
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </div>
</body>

</html>
