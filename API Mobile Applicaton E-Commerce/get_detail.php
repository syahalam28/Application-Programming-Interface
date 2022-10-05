<?php 
$con = new mysqli("localhost","root","","SalesWeb");
$st_check=$con->prepare("SELECT id,name,price,qty,mob,mobile FROM temp_order INNER JOIN items ON items.id=temp_order.itemid WHERE mob=?");
$st_check->bind_param("s",$_GET["mob"]);
$st_check->execute();
$rs=$st_check->get_result();
$arr=array();
while ($row=$rs->fetch_assoc())
{
	array_push($arr,$row);
}

echo json_encode($arr);




 ?>