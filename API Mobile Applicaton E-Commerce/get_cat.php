<?php 

$con = new mysqli("localhost","root","","SalesWeb");
$st_check=$con->prepare("SELECT DISTINCT category FROM items");
$st_check->execute();
$rs=$st_check->get_result(); 
$arr=array();
while ($row=$rs->fetch_assoc()) 
{
	array_push($arr, $row);
}

echo json_encode($arr);


 ?>