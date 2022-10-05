<?php 

include 'koneksi.php';

$response = array();

$nama = $_POST['nim'];
$email = $_POST['nama'];
$password = $_POST['password'];

if(!$nama || !$email || !$password){
	$response['success'] = 0;
	$response['msg'] = "Data tidak lengkap";
}else{
	$query = "INSERT INTO mhs(nim, nama, password) VALUES(?, ?, ?)";

	if($stmt = $con->prepare($query)){
		$stmt->bind_param('sss', $nama, $email, $password);

		$stmt->execute();

		if($stmt){
			$response['success'] = 1;
			$response['msg'] = "Berhasil Tambah data";
		}else{
			$response['success'] = 0;
			$response['msg'] = "Gagal Tambah data";
		}
	}else{
		$response['success'] = 0;
		$response['msg'] = mysqli_error();
	}
}

echo json_encode($response);

?>