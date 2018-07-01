<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Aiims";
	
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_eroor){
	die("Connection failed: " . $conn->connect_error);
}

$fileid = $_POST["fileid"];
$filename = $_POST["filename"];
$department = $_POST["department"];
$fileholder = $_POST["fileholder"];

//$fileid = (int)$fileid;

$sql = "SELECT id FROM FileData WHERE fileid = '".$fileid."'";

$result = $conn->query($sql);
if($result->num_rows > 0){
	$response->status = "ERROR";
	$response->Message = "File Already Exists";
	
	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}

$sql = "INSERT INTO FileData(fileid,filename,department,fileholder) 
		VALUES ('".$fileid."','".$filename."','".$department."','".$fileholder."')";

if($conn->query($sql) === TRUE){
	$response->status = "SUCCESS";
	$response->Message = "File Added Successfully";

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}else{
	$response->status = "ERROR";
	$response->Message = $conn->error;

	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
	exit();
}
?>