<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Aiims";
	
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_eroor){
	die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];
$password = md5($password);

$sql = "SELECT id,password FROM user_profile WHERE username = '".$username."'";

$result = $conn->query($sql);

if($result->num_rows == 0){
	$response->status = "FAILURE";
	$response->Message = "Username doesn't exist";

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}

$rows = $result->fetch_assoc();
//echo $rows["password"];
//echo md5($password);
if($rows["password"] != $password){
//	echo $rows["password"];
	$response->status = "FAILURE";
	$response->Message = "Incorrect Password";

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}

$response->status = "SUCCESS";
$response->Message = "login Successfull";

$responseJson = json_encode($response);
echo $responseJson;
$conn->close();
?>