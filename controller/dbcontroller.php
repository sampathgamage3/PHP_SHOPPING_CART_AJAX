<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "cart";
	
	function __construct() {
		$conn = $this->connectDB();
		// if(!empty($conn)) {
		// 	$this->selectDB($conn);
		// }
	}
	
	function connectDB() {
		$conn = mysqli_connect("localhost","root","","cart");
		return $conn;
	}
	
	// function selectDB($conn) {
	// 	mysql_select_db($this->database,$conn);
	// }
	
	function runQuery($conn,$query) {
		$result = mysqli_query($conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($conn,$query) {
		$result  = mysqli_query($conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>