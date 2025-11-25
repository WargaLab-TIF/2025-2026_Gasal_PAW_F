<?php
    // Koneksi ke database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "store";
    $koneksi = mysqli_connect($hostname, $username, $password, $dbname);

    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }
?>