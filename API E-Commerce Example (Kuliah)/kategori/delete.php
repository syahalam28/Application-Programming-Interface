<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/kategori.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$kategori = new kategori($db);

// get product kategori_id
$data = json_decode(file_get_contents("php://input"));

// set product kategori_id to be deleted
$kategori->kategori_id = $data->kategori_id;

// delete the product
if ($kategori->hapus()) {

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Data kategori Telah Dihapus."));
}

// if unable to delete the product
else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Gagal menghapus data kategori."));
}
