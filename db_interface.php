<?php

class Database {
	private $host;
	private $userName;
	private $password;
	private $database;
	private $conn;

	public function __construct($host, $userName, $password, $database) {
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
		$this->database = $database;
	}
	
	public function signUp(){
 
		$regName = $regAdress = $regPassword = $regRepassword = "";

		$regName = $_POST['regName'];
		$regAdress = $_POST['regAdress'];
		$regPassword = $_POST['regPassword'];
		$regRepassword = $_POST['regRepassword'];

	
		//check that all fields are filled
		if ($regName == "" || $regAdress == "" || $regPassword == "" || $regRepassword == "" ) {
			return "All fields must be filled in";
		}

		//check passwords match
		if ($regPassword != $regRepassword) {
			return "Password's mismatch...";
		}
	
		//validate inputs
		$regName  = $this->validateInput($regName);
		$regAdress = $this->validateInput($regAdress);
		$regPassword = $this->validateInput($regPassword);
		$regRepassword = $this->validateInput($regRepassword);

		//password constraints
		//add regex or something that checks password-length etc..

		//more checks?

		//connecting to database
		$this->openConnection();
		if(! $this->isConnected()) {
 			 return "Could not connect to database..";
		}


		//check if user exists		
		if ($this->userExists($regName)) {
			return "Username already exists.. Pick another one.";
		}

		//generate hash + salt
		$hashAndSalt = password_hash($regPassword, PASSWORD_DEFAULT);
		echo "<br> Hash and Salt: " . $hashAndSalt . "<br>";

		$this->addUser($regName,$regAdress,$hashAndSalt);

		//print all inputs (just for testing)
		$msg = $regName . $regAdress . $regPassword . $regRepassword;
		return $msg;
		
	}

	private function addUser($regName,$regAdress,$hashAndSalt) {

	}

	private function validateInput($input) {

	
		$input = trim($input); //removes extra spaces, tabs, newlines..
		$input = stripslashes($input); //remove backslashes
		$input = htmlspecialchars($input); //preventing "tagged" input..<script> etc.
		

		return $input;

		

	}
	
	private function userExists($username){

		$query = "SELECT username FROM users WHERE username =?";
 		$result = $this->executeQuery ( $sql, array (
				$username 
		) );

		return count ( $result ) == 1;
	}
	
	private function generateSalt(){
		
	}
	
	public function signIn(){
		
	}
	
	public function getItem($productId){
		
	}
	
	public function signOut(){
		
	}
	
	

	public function openConnection() {
		try {
			$this->conn = new PDO ( "mysql:host=$this->host;dbname=$this->database", $this->userName, $this->password );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			$error = "Connection error: " . $e->getMessage ();
			print $error . "<p>";
			unset ( $this->conn );
			return false;
		}
		return true;
	}


	public function closeConnection() {
		$this->conn = null;
		unset ( $this->conn );
	}

	/*


	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset ( $this->conn );
	}

	public function getAllProducts() {

		$query = "SELECT * FROM products";

 		$param = array();

		return $this->executeQuery($query, $param);

	}

	/**
	 * Execute a database query (select).
	 *
	 * @param $query The
	 *        	query string (SQL), with ? placeholders for parameters
	 * @param $param Array
	 *        	with parameters
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ( $param );
			$result = $stmt->fetchAll ();
		} catch ( PDOException $e ) {
			$error = "*** Internal error: " . $e->getMessage () . "<p>" . $query;
			die ( $error );
		}
		return $result;
	}

	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The
	 *        	query string (SQL), with ? placeholders for parameters
	 * @param $param Array
	 *        	with parameters
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ( $param );
			$affected_rows = $stmt->rowCount ();
			// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch ( PDOException $e ) {
			$error = "*** Internal error: " . $e->getMessage () . "<p>" . $query;
			return 0;
			// die ( $error );
		}

		return $affected_rows;
	}

/*
TODO: here should all the hash-comparing and stuff happen
*/
	public function login($userId) {
			$sql = "SELECT username FROM users WHERE username = ?";
			$result = $this->executeQuery ( $sql, array (
					$userId
			) );
			return count ( $result ) == 1;
		}
	/*



	*/



}
?>
