<?php

// header untuk membatasi akses dan jenis konten 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include file database dan object
include_once '../config/database.php';
include_once '../objects/kategori.php';

// inisialisasi database dan objek kategori
$database = new Database();
$db = $database->getConnection();

$kategori = new kategori($db);

// set kategori_id
$kategori->kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : die();

// read the details of product to be edited
$kategori->tampilSatuData();

if ($kategori->kategori != null) {
    // membuat array
    $kategori_arr = array(
        "kategori_id" =>  $kategori->kategori_id,
        "kategori" => $kategori->kategori,
        "status" => $kategori->status

    );

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
