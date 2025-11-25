<?php 
include "koneksi.php"; 
session_start(); 
if ($_SESSION['level'] == "") { 
header("location: login.php?pesan=gagal"); 
} 
 
// Simulasikan nama pengguna yang sudah login (sesuaikan dengan cara Anda menangani login) 
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Kasir'; 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial
scale=1.0"> 
    <title>Contoh Navigasi</title> 
    <style> 
        /* Style untuk navigasi */ 
        nav { 
            background-color: #333; 
            overflow: hidden; 
        } 
 
        .sales-system { 
            float: left; 
            color: white; 
            padding: 14px 16px; 
            font-size: 18px; 
        } 
 
        nav a { 
            float: left; 
            display: block; 
            color: white; 
            text-align: center; 
            padding: 14px 16px; 
            text-decoration: none; 
        } 
 
        nav a:hover { 
            background-color: #ddd; 
            color: black; 
        } 
 
        /* Style untuk nama pengguna di pojok kanan atas */ 
        .user-info { 
            float: right; 
            color: white; 
            padding: 14px 16px; 
        } 
 
        .dropdown { 
            float: left; 
            overflow: hidden; 
        } 
 
        .dropdown .dropbtn { 
            font-size: 16px; 
            border: none; 
            outline: none; 
            color: white; 
            background-color: inherit; 
            font-family: inherit; 
            margin: 0; 
            padding: 14px 16px; 
            cursor: pointer; 
        } 
 
        .dropdown-content { 
            display: none; 
            position: absolute; 
            background-color: #f9f9f9; 
            min-width: 160px; 
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); 
            z-index: 1; 
        } 
 
        .dropdown-content a { 
            float: none; 
            color: black; 
            padding: 12px 16px; 
            text-decoration: none; 
            display: block; 
            text-align: left; 
        } 
 
        .dropdown-content a:hover { 
            background-color: #ddd; 
        } 
 
        .dropdown:hover .dropdown-content { 
            display: block; 
        } 
    </style> 
 
    <!-- Font Awesome (Tambahkan ini jika belum ada) --> 
    <link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0
beta3/css/all.min.css"> 
</head> 
<body> 
 
<!-- Navigasi --> 
<nav> 
    <div class="sales-system"> 
        <i class="fa fa-shopping-cart"></i> Sistem Penjualan 
    </div> 
    <a href="index.php">Home</a> 
    <div class="dropdown"> 
        <button class="dropbtn">Data Master</button> 
        <div class="dropdown-content"> 
            <a href="user.php">User</a> 
            <a href="supplier.php">Supplier</a> 
            <a href="barang.php">Barang</a> 
        </div> 
    </div> 
    <a href="transaksi.php">Transaksi</a> 
    <a href="laporan.php">Laporan</a> 
    <div class="user-info"> 
        <div class="dropdown"> 
            <span>Selamat datang, <?php echo $username; ?></span> 
            <div class="dropdown-content"> 
                <a href="profil.php">Profil</a> 
                <a href="logout.php">Logout</a> 
            </div> 
        </div> 
    </div> 
</nav> 
 
<<!-- Isi konten halaman di sini --> 
<div style="padding: 20px; text-align: center;"> 
    <h1>Selamat Datang di Sistem Penjualan</h1> 
    <p>Ini adalah halaman utama dari sistem penjualan. Silakan 
navigasikan menu di atas untuk mengakses berbagai fitur.</p> 
 
    <img src="https://example.com/illustration.png" alt="Illustration" 
style="max-width: 100%; height: auto; margin-top: 20px;"> 
 
    <h2>Fitur Utama</h2> 
    <ul style="list-style-type: none; padding: 0;"> 
<li>&#8226; <strong>Data Master:</strong> Kelola data pengguna, 
supplier, barang, dll.</li> 
<li>&#8226; <strong>Transaksi:</strong> Catat dan kelola 
transaksi penjualan.</li> 
<li>&#8226; <strong>Laporan:</strong> Lihat laporan penjualan 
dan statistik lainnya.</li> 
</ul> 
<h2>Profil Pengguna</h2> 
<p>Anda dapat mengakses profil pengguna dan melakukan logout 
melalui menu dropdown di pojok kanan atas.</p> 
<h2>Hubungi Kami</h2> 
<p>Jika Anda memiliki pertanyaan atau masalah, silakan hubungi 
layanan pelanggan kami.</p> 
<p>Email: support@sistempenjualan.com</p> 
</div> 
</body> 
</html>