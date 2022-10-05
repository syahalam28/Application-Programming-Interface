<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/kategori.php';

// koneksi database
$database = new Database();
$db = $database->getConnection();

// menyiapkan kategori object
$kategori = new kategori($db);

// mendapatkan kategori_id dari kategori yang akan diedit
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$kategori->kategori_id = $data->kategori_id;

// set product property values
$kategori->kategori = $data->kategori;
$kategori->status = $data->status;


// update the product
if ($kategori->ubah()) {

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Data Kategori telah diubah."));
}

// if unable to update the product, tell the user
else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Gagal mengubah data kategori."));
}
