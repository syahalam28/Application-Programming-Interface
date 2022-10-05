<?php

class kategori
{

    // koneksi database beserta nama tabel
    private $conn;
    private $table_name = "mahasiswa";

    // object properties (kolom pada tabel kategori)
    public $nim;
    public $nama_mahasiswa;
    public $jenis_klamin;
    public $tanggal_lahir;
    public $kode_prodi;
    

    // constructor untuk koneksi database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // method CRUD akan ditambahkan disini

    // function untuk menampilkan semua data kategori
    function tampil()
    {
        // query untuk menampilkan semua data
        $query = "SELECT nim,nama_mahasiswa,nama_prodi FROM mahasiswa INNER JOIN prodi on mahasiswa.kode_prodi=prodi.kode_prodi";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // eksekusi query
        $stmt->execute();
        return $stmt;
    }

  
  
}
