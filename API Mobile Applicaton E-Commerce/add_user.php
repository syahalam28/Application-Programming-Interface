<?php 

$con = new mysqli("localhost","root","","SalesWeb");
$st_check=$con->prepare("SELECT * FROM users WHERE mobile=?");
$st_check->bind_param("s",$_GET["mobile"]);
$st_check->execute();
$rs=$st_check->get_result(); 

if($rs->num_rows==0)
{

$st=$con->prepare("INSERT INTO users VALUES(?,?,?,?,?)");
$st->bind_param("sssss",$_GET["mobile"],$_GET["password"],$_GET["name"],$_GET["address"],$_GET["level"]);
$st->execute();
echo "1";

}
else
{
echo "0";
}

 


 ?>
