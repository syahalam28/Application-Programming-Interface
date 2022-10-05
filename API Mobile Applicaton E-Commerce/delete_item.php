<?php 
$con = new mysqli("localhost","root","","SalesWeb");
$st_check=$con->prepare("DELETE FROM items WHERE id=?");
$st_check->bind_param("s",$_GET["id"]);
$st_check->execute();




 ?>