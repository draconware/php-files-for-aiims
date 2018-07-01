<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Aiims";
	
$conn = new mysqli($servername,$username,$password,$dbname);

	
if($conn->connect_error){
	die("Connection faile: " . $conn->connect_error);
}

$username = $_POST["username"];
//echo "username is " . $username;

$password=$_POST["password"];
$password = md5($password);

$emailid=$_POST["email"];

$firstname=$_POST["firstname"];

$lastname=$_POST["lastname"];

$department=$_POST["department"];

$sql = "SELECT id FROM user_profile WHERE email = '".$emailid."'";

$result = $conn->query($sql);

if($result->num_rows > 0){
	$response->status = "FAILURE";
	$response->Message = "emailid already exists";

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}
$sql = "SELECT id FROM user_profile WHERE username = '".$username."'";

$result = $conn->query($sql);


if($result->num_rows > 0){
	$response->status = "FAILURE";
	$response->Message = "username already exists";

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}

$sql = "INSERT INTO user_profile (firstname,lastname,username,password,email,department) 
		VALUES ('".$firstname."','".$lastname."','".$username."','".$password."','".$emailid."','".$department."')";

if($conn->query($sql) === TRUE){
    $response->status = "SUCCESS";
    $response->Message = "registered successfully";

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}else{
    $response->status = "FAILURE";
	$response->Message = $conn->error;

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}
?>