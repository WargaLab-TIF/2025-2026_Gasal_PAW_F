<?php
    $host = "localhost";
    $user = "root"; // Ganti jika username database Anda berbeda
    $pass = ""; // Ganti jika password database Anda berbeda
    $db = "store";

    $koneksi = mysqli_connect($host, $user, $pass, $db);

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>