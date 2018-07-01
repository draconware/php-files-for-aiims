<?php
	function getConnection(){
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "Aiims";
	
		$conn = new mysqli($servername,$username,$password,$dbname);

	
		if($conn->connect_error){
			die("Connection faile: " . $conn->connect_error);
		}else{
			echo $conn;
		}
	}

	function closeConnection($conn){
		$conn->close();
	}
?>