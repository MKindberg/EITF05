<!DOCTYPE html>
<?php
    if(isset($_COOKIE["logged in"])){
        $signInOut = '<a href="signOut.php">Sign out</a>';
        $account = '<a href="account.php">Account</a>';
    }
    else{
        $signInOut = '<a href="signIn.php">Sign in</a>';
        $account = '<a href="signUp.php">Sign up</a>';
    }
    $cart = '<a href="cart.php">Cart (' .count($_COOKIE["cart"]) . ')</a>';
 ?>
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
    <?php echo $ht; ?>
</body>

</html>
