<?php 
$con = new mysqli("localhost","root","","SalesWeb");
$st_check=$con->prepare("SELECT * FROM users WHERE mobile=? AND password=? AND level=?");
$st_check->bind_param("sss",$_GET["mobile"],$_GET["password"],$_GET["level"]);
$st_check->execute();
$rs=$st_check->get_result(); 

if($rs->num_rows==0)
{
	echo "0";
}
else
{
	
	echo "1";
}




 ?>