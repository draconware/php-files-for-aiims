<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Aiims";
	
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_eroor){
	die("Connection failed: " . $conn->connect_error);
}

class fileitems{
	public $fileid,$filename,$fileholder,$filedepartment;

	public function setid($id){
		$this->fileid = $id;
	}

	public function setname($name){
		$this->filename = $name;
	}

	public function setholder($holder){
		$this->fileholder = $holder;
	}

	public function setdepartment($department){
		$this->filedepartment = $department;
	}
}

$fileid = $_GET["fileid"];
$filename = $_GET["filename"];
$filedepartment = $_GET["filedepartment"];

$response = array();
//echo $fileid . " " . $filename . " " . $filedepartment . "\n";

$sql=null;

if($fileid != null && $filename!=null && $filedepartment!=null){

	$sql = "SELECT * FROM FileData WHERE fileid LIKE '%".$fileid."%' OR filename LIKE '%".$filename."%' OR department LIKE '%".$filedepartment."%'";

}else if($fileid==null && $filename==null && $filedepartment!=null){

	$sql = "SELECT * FROM FileData WHERE department LIKE '%".$filedepartment."%'";

}else if($fileid==null && $filename!=null && $filedepartment==null){

	$sql = "SELECT * FROM FileData WHERE filename LIKE '%".$filename."%'";

}else if($fileid!=null && $filename==null && $filedepartment==null){

	$sql = "SELECT * FROM FileData WHERE fileid LIKE '%".$fileid."%'";

}else if($fileid==null && $filename!=null && $filedepartment!=null){

	$sql = "SELECT * FROM FileData WHERE filename LIKE '%".$filename."%' OR department LIKE '%".$filedepartment."%'";

}else if($fileid!=null && $filename!=null && $filedepartment==null){

	$sql = "SELECT * FROM FileData WHERE fileid LIKE '%".$fileid."%' OR filename LIKE '%".$filename."%'";

}else if($fileid!=null && $filename==null && $filedepartment!=null){

	$sql = "SELECT * FROM FileData WHERE fileid LIKE '%".$fileid."%' OR department LIKE '%".$filedepartment."%'";

}else{
	echo "Error";
	$conn->close();
}
//echo $sql;
$result = $conn->query($sql);

if($result->num_rows > 0){
	while($rows = $result->fetch_assoc()){
		$obj = new fileitems;

		$obj->setid($rows["fileid"]);
		$obj->setname($rows["filename"]);
		$obj->setdepartment($rows["department"]);
		$obj->setholder($rows["fileholder"]);

		array_push($response,$obj);
	}

	print_r($response);

	//header("Content-type:application/json"); 
	$responseJson = json_encode($response);
	echo $responseJson;
	$conn->close();
}

?>

