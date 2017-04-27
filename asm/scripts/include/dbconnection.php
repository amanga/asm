<?php
	class DBConnection{
		private $conn;
		public function getConnection(){
			$servername = "localhost";
			$username = "test";
			$password = "Bunge123";
			$dbname = "testdb";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			// echo "Connected successfully";
			return $conn;
		}
		public function closeConnection(){
			$conn->close();
			echo "<br/>Connected closed";
		}
	}
?>