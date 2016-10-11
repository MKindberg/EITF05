<?php
require_once ('db_interface.php');
require_once ("mysql_login_data.php");

$db = new Database ( $host, $userName, $password, $database );
$db->openConnection ();
if (! $db->isConnected ()) {
	header ( "Location: db_not_connected.php" );
	exit ();
}




$userId = $_REQUEST ['userId'];
if (! $db->userExists ( $userId )) {
	$db->closeConnection ();
	header ( "Location: noSuchUser.html" );
	exit ();
}
$db->closeConnection ();



session_start ();
$_SESSION ['db'] = $db;
$_SESSION ['userId'] = $userId;
header ( "Location: where??" );
?>
