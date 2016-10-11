<?php
    session_start();

    if (!isset($_SESSION['ServGen'])) {
      unset($_SESSION["loggedIn"]);
    }
    session_regenerate_id();
    $_SESSION['ServGen']= true;

    if(isset($_SESSION["loggedIn"])){
        $account = '<a href="signOut.php" >Sign out</a>';
        $signInOut = 'Signed in as '.$_SESSION["loggedIn"];
    }
    else{
        $signInOut = '<a href="signIn.php">Sign in</a>';
        $account = '<a href="signUp.php">Sign up</a>';
    }
    if(isset($_COOKIE["items"])){
        $items = json_decode($_COOKIE["items"], true);
        $cart = '<a href="cart.php">Cart (' .array_sum($items) . ')</a>';
    } else
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
