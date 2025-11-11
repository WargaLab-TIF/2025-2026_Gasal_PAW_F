<?php
 $conn = mysqli_connect("localhost", "root", "", "penjualan");
 if (!$conn){
    die("koneksi gagal".mysqli_connect_errno());
 }