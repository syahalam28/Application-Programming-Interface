<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// koneksi database dan inisialisasi object
include_once '../config/database.php';
include_once '../objects/ketegori.php';

$database = new Database();
$db = $database->getConnection();

$kategori = new kategori($db);

// mendapatkan data yang telah ada
$data = json_decode(file_get_contents("php://input"));

// memastikan data tidak kosong
if (
    !empty($data->kategori_id) &&
    !empty($data->kategori) &&
    !empty($data->status)
) {

    // mengatur nilai property kategori
    $kategori->kategori_id = $data->kategori_id;
    $kategori->kategori = $data->kategori;
    $kategori->status = $data->status;

    // menyimpan kategori
    if ($kategori->simpan()) {

        // set response code - 201 created
        http_response_code(201);

        // data kategori berhasil tersimpan
        echo json_encode(array("message" => "Data kategori tersimpan."));
    } else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // menampilkan ke user bahwa data kategori gagal disimpan
        echo json_encode(array("message" => "Gagal menyimpan data kategori."));
    }
}
// jika data tidak komplet
else {

    // set response code - 400 bad request
    http_response_code(400);

    // data yang dimasukkan kurang lengkap
    echo json_encode(array("message" => "Gagal menambahkan data kategori. Data tidak lengkap."));
}
