<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$delete_database = "DROP DATABASE IF EXISTS penjualan";

$create_database = "CREATE DATABASE IF NOT EXISTS penjualan;";
if (mysqli_query($conn, $delete_database) && mysqli_query($conn, $create_database)) {
    echo "Database berhasil dibuat\n";
} else {
    die("Gagal membuat database: " . mysqli_error($conn) . "\n");
}

mysqli_select_db($conn, "penjualan");

$pelanggan = "CREATE TABLE IF NOT EXISTS pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(20) NOT NULL,
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);";

$user = "CREATE TABLE IF NOT EXISTS user (
    id_user TINYINT(2) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150) NOT NULL,
    hp VARCHAR(20) NOT NULL,
    level TINYINT(1)
);";

$supplier = "CREATE TABLE IF NOT EXISTS supplier (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12) NOT NULL,
    alamat TEXT
);";

$barang = "CREATE TABLE IF NOT EXISTS barang (
    id INT PRIMARY KEY AUTO_INCREMENT,
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
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id),
    FOREIGN KEY (user_id) REFERENCES user(id_user)
);";

$pembayaran = "CREATE TABLE IF NOT EXISTS pembayaran (
    id INT PRIMARY KEY AUTO_INCREMENT,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT NOT NULL UNIQUE,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);";

$transaksi_detail = "CREATE TABLE IF NOT EXISTS transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (barang_id) REFERENCES barang(id)
);";

$query_list = [
    $pelanggan,
    $user,
    $supplier,
    $barang,
    $transaksi,
    $pembayaran,
    $transaksi_detail
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
