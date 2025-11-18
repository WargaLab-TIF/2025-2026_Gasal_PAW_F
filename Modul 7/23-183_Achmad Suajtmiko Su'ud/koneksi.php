<?php

$host = "localhost";
$user = "root";
$pass = "admin";
$db = "penjualan";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

function formatRupiah($angka)
{
    return 'Rp' . number_format($angka, 0, ',', '.');
}

date_default_timezone_set('Asia/Jakarta');
