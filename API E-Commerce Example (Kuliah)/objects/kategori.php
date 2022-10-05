<?php

class kategori
{

    // koneksi database beserta nama tabel
    private $conn;
    private $table_name = "tb_kategori";

    // object properties (kolom pada tabel kategori)
    public $kategori_id;
    public $kategori;
    public $status;

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
        $query = "SELECT * FROM tb_kategori ORDER BY kategori ASC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // eksekusi query
        $stmt->execute();
        return $stmt;
    }
    // function untuk menampilkan semua data kategori
    function tampilSatuData()
    {
        // query untuk membaca satu data
        $query = "SELECT * FROM tb_kategori WHERE kategori_id = ?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // binding kategori_id
        $stmt->bindParam(1, $this->kategori_id);
        // eksekusi query
        $stmt->execute();
        // mengambil satu data kategori sesuai kategori_id
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // memberikan nilai ke object properties
        $this->kategori_id = $row['kategori_id'];
        $this->kategori = $row['kategori'];
        $this->status = $row['status'];
    }
    // function untuk menyimpan data kategori
    function simpan()
    {
        // query untuk menyimpan data 
        $query = "INSERT INTO tb_kategori (kategori_id,kategori,status) VALUES (:kategori_id,:kategori,:status) ";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->kategori_id = htmlspecialchars(strip_tags($this->kategori_id));
        $this->kategori = htmlspecialchars(strip_tags($this->kategori));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // bind nilai property
        $stmt->bindParam(":kategori_id", $this->kategori_id);
        $stmt->bindParam(":kategori", $this->kategori);
        $stmt->bindParam(":status", $this->status);


        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // function untuk mengubah data ketegori
    function ubah()
    {
        // query ubah data
        $query = "UPDATE " . $this->table_name . "
                    SET
                        kategori = :kategori,
                        status = :status
                    WHERE
                        kategori_id = :kategori_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->kategori = htmlspecialchars(strip_tags($this->kategori));
        $this->status = htmlspecialchars(strip_tags($this->status));


        // bind new values
        $stmt->bindParam(':kategori', $this->kategori);
        $stmt->bindParam(':status', $this->status);


        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // function untuk menghapus data kategori
    function hapus()
    {
        // query hapus
        $query = "DELETE FROM tb_kategori WHERE kategori_id = ?";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->kategori_id = htmlspecialchars(strip_tags($this->kategori_id));
        // bind kategori_id of record to delete
        $stmt->bindParam(1, $this->kategori_id);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
