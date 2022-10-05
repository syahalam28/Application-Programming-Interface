<?php 
include 'koneksi.php';

// Prepare dan bind
$query = "INSERT INTO mhs(nim,nama,prodi) VALUES(?,?,?)";
$stmt = $con->prepare($query);
// Argument bind_parm
// s-string
// i-integer
// d-ganda
$stmt->bind_param('sss',$nim,$name,$prodi);

//Set parameter dan eksekusi
$nim = "678";
$name = "Joe";
$prodi = "Kehutanan";
$stmt->execute();

if ($stmt) {
	# code...
	$response['success'] = 1;
	$response['msg'] = "Berhasil Tambah Data";
}else{
	$response['success'] = 0;
	$response['msg'] = "Gagal Tambah Data";
}

echo json_encode($response);

 ?>