<?php
    session_start();
    if(isset($_SESSION["loggedIn"])){
        $signInOut = '<a href="signOut.php" >Sign out</a>';
        $account = '<a href="account.php">Signed in as '.$_SESSION["loggedIn"].'</a>';
    }
    else{
        $signInOut = '<a href="signIn.php">Sign in</a>';
        $account = '<a href="signUp.php">Sign up</a>';
    }
    if(isset($_COOKIE["cart"]))
        $cart = '<a href="cart.php">Cart (' .count($_COOKIE["cart"]) . ')</a>';
    else
        $cart = '<a href="cart.php">Cart</a>';

 ?>
<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="header.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="navbar">
        <p><a href="index.php">Home</a></p>
        <ul>
            <li><?php echo $signInOut; ?></li>
            <li><?php echo $account; ?></li>
            <li><?php echo $cart; ?></li>
        </ul>
    </div>
</body>

</html>
