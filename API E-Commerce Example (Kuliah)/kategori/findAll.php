<?php

// header untuk membatasi akses dan jenis konten 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include file database dan object
include_once '../config/database.php';
include_once '../objects/kategori.php';

// inisialisasi database dan objek kategori
$database = new Database();
$db = $database->getConnection();

$kategori = new kategori($db);

// query kategori
$stmt = $kategori->tampil();
$num = $stmt->rowCount();

// cek jika ditemukan lebih dari 0 data kategori
if ($num > 0) {
    // array kategori
    $kategori_arr = array();
    $kategori_arr["records"] = array();

    // mengambil isi tabel
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract baris
        extract($row);
        $kategori_item = array(
            "kategori_id" => $kategori_id,
            "kategori" => $kategori,
            "status" => $status

        );
        array_push($kategori_arr["records"], $kategori_item);
    }

    // set response code - 200 OK
    http_response_code(200);
    // menampilkan data kategori dalam format json
    echo json_encode($kategori_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // menampilkan ke user kategori tidak ditemukan
    echo json_encode(
        array("message" => "Kategori tidak ditemukan.")
    );
}
