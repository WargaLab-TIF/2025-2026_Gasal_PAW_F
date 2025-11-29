<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "store";

    $koneksi = mysqli_connect($host,$user,$pass,$db);
    if (!$koneksi) {
        die ("Tidak bisa terkoneksi ke database: " . mysqli_connect_error());
    }

    $result = mysqli_query($koneksi,"SELECT * FROM supplier");
?>