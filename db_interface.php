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

		$pwdMinLen = 8;

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
		//add regex or something that checks password-length, different symbols etc..
		if(strlen($regPassword)<$pwdMinLen)
			return "Password must be at least " . $pwdMinLen . " characters";

		if(!preg_match("/\d/", $regPassword))
			return "Password must contain at least one digit";
		else if(!preg_match("/\W/", $regPassword))
			return "Password must contain at least one special character";
		else if(!preg_match("/[a-z]/", $regPassword) or !preg_match("/[A-Z]/", $regPassword))
			return "Password must contain both upper- and lowercase letters";

		//more checks before involving database?

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

		//adding user to database
		$msg = $this->addUser($regName,$hashAndSalt,$regAdress);

		//print all inputs (just for testing)
		//$msg = $regName . $regAdress . $regPassword . $regRepassword;
		return $msg;

	}

	private function addUser($regName,$hashAndSalt,$regAdress) {

		$query = "INSERT into users values(?,?,?);";
		$params = array();
		array_push($params,$regName,$hashAndSalt,$regAdress);
		$result = $this->executeUpdate($query,$params);
		return "Successfully signed up " . " Username : ". $regName . " Adress : " . $regAdress;
	}

	private function validateInput($input) {

		//add more validations?

		$input = trim($input); //removes extra spaces, tabs, newlines..
		$input = stripslashes($input); //remove backslashes
		$input = htmlspecialchars($input); //preventing "tagged" input..<script> etc.


		return $input;


	}

	private function userExists($username){

		$query = "SELECT username FROM users WHERE username =?";
		$param = array ();
		array_push ( $param, $username );

 		$result = $this->executeQuery ( $query,$param);

		return count ( $result ) == 1;
	}


//TODO remane variables?
	public function signIn(){

		$name = $password = "";

		$name = $_POST['name'];
		$password = $_POST['password'];

		$this->openConnection();
		if(! $this->isConnected())
 			 return "Could not connect to database..";

		if(! $this->userExists($name))
			return "User " . $name . " doesn't exist";

		if(password_verify($password, $this->getHash($name)))
            setcookie("logged in", "", time() + (3600), "/"); //set cookie for one hour
	    $this->closeConnection;
	}

	public function getItem($productId){
		//open connection
		//return product if exists, else error
	}

	public function signOut(){
		setcookie("logged in", "", time()-3600); //removes cookie
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

    private function getHash($username){
        $query = "SELECT hash FROM users WHERE username =?";
		$param = array ();
		array_push ( $param, $username );

 		$result = $this->executeQuery ($query, $param);

		return $result[0][0];
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
