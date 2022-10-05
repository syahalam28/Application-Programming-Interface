<?php 
// Menampilkan seluruh data pada tabel temp_order
$con = new mysqli("localhost","root","","SalesWeb");
$st=$con->prepare("SELECT * FROM temp_order WHERE mobile=?");
$st->bind_param("s",$_GET["mobile"]);
$st->execute();
$rs=$st->get_result();

// Memasukan data kedalam tabel bill
$st2=$con->prepare("INSERT INTO bill(mobile) VALUES(?) ");
$st2->bind_param("s",$_GET["mobile"]);
$st2->execute();

// Menampilkan data dari tabel bill dengan bill terakhir
$st4=$con->prepare("SELECT max(bill_no) AS bno FROM bill WHERE mobile=?");
$st4->bind_param("s",$_GET["mobile"]);
$st4->execute();
$rs2=$st4->get_result();
$row_max=$rs2->fetch_assoc();


// Memasukan data kedalam tabel bill_det
while($row=$rs->fetch_assoc()){
	$st3=$con->prepare("INSERT INTO bill_det VALUES(?,?,?)");
	$st3->bind_param("iii", $row_max["bno"],$row["itemid"],$row["qty"]);
	$st3->execute();
}

// Menghapus data dari temp_order
$st5=$con->prepare("DELETE FROM temp_order WHERE mobile=?");
$st5->bind_param("s",$_GET["mobile"]);
$st5->execute();

echo $row_max["bno"];
 ?>