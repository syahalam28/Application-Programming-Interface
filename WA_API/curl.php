<?php

 $tanggal =  date('Y-m-d ');
 $hp = 6287843107132;
$BASE_URL = 'https://api.nusasms.com/nusasms_api/1.0/whatsapp/message';
// $BASE_TEST_URL = 'https://dev.nusasms.com/nusasms_api/1.0/whatsapp/message';

$curl = curl_init();
$payload = json_encode(array(
    // 'sender' => 'YOUR_SENDER',
    'destination' => $hp,
    'message' => 'Anda Berhasil Melakukan Presensi Tanggal '.$tanggal. ' Selamat Berkerja & Semoga Hari Anda Menyenangkan'
));
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $BASE_URL,
    // For testing
    // CURLOPT_URL => $BASE_TEST_URL,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => array(
        "APIKey: AA327B04DDFDB4551CA06BF74E03BF0B",
        'Content-Type:application/json'
    ),
    CURLOPT_POSTFIELDS => $payload,
    // CURLOPT_SSL_VERIFYPEER => 0,    // Skip SSL Verification
));

$resp = curl_exec($curl);

if (!$resp) {
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
} else {
    echo $resp;
}
curl_close($curl);