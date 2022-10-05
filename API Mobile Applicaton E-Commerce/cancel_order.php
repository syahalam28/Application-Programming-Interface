<?php 
$con = new mysqli("localhost","root","","SalesWeb");
$st_check=$con->prepare("DELETE FROM temp_order WHERE mobile=?");
$st_check->bind_param("s",$_GET["mobile"]);
$st_check->execute();




 ?>