<?php 
$con = new mysqli("localhost","root","","SalesWeb");
$st=$con->prepare("SELECT *  FROM items WHERE mob=?");
$st->bind_param("s",$_GET["mob"]);
$st->execute();
$rs=$st->get_result();
$arr = array();
while ($row=$rs->fetch_assoc())
{
	array_push($arr, $row);
}
echo json_encode($arr);



 ?>