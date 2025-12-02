<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$delete_database = "DROP DATABASE IF EXISTS penjualan_tp7";

$create_database = "CREATE DATABASE IF NOT EXISTS penjualan_tp7;";
if (mysqli_query($conn, $delete_database) && mysqli_query($conn, $create_database)) {
    echo "Database berhasil dibuat\n";
} else {
    die("Gagal membuat database: " . mysqli_error($conn) . "\n");
}

mysqli_select_db($conn, "penjualan_tp7");

$pelanggan = "CREATE TABLE IF NOT EXISTS pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);";

$supplier = "CREATE TABLE IF NOT EXISTS supplier (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12) NOT NULL,
    alamat TEXT
);";

$barang = "CREATE TABLE IF NOT EXISTS barang (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT NOT NULL,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) 
);";

$transaksi = "CREATE TABLE IF NOT EXISTS transaksi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT NOT NULL, 
    total INT NOT NULL NOT NULL,
    pelanggan_id VARCHAR(20) NOT NULL,
    user_id TINYINT(2) NOT NULL,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);";


$query_list = [
    $pelanggan,
    $supplier,
    $barang,
    $transaksi
];

foreach ($query_list as $query) {
    if (mysqli_query($conn, $query)) {
        echo "Tabel berhasil dibuat \n";
    } else {
        echo "Gagal membuat tabel: " . mysqli_error($conn) . "\n";
    }
}

mysqli_close($conn);

?>
