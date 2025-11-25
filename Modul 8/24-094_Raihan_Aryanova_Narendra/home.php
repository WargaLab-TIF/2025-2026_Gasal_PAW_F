<?php 
include 'cek_session.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Sistem Penjualan</title>
    <style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", sans-serif;
}

/* BODY */
body {
    background: #f4f4f8; 
    color: #1b1f3b;
}

/* NAVBAR */
.navbar {
    background: #1b1f3b;
    display: flex;
    padding: 10px 20px;
    align-items: center;
    gap: 20px; /* jarak antar elemen kiri */
}

/* LINK */
.navbar a {
    color: white;
    text-decoration: none;
    font-size: 15px;
    padding: 10px 14px;
    border-radius: 6px;
    display: block;
}

/* HOVER */
.navbar a:hover,
.dropdown:hover .dropbtn {
    background: #7a3cff;
    color: white;
}

/* UL MENU */
.navbar-nav {
    display: flex;
    list-style: none;
    gap: 5px; /* jarak antar item */
}

/* -------------------------------- */
/* DROPDOWN (sudah fix tidak hilang) */
/* -------------------------------- */
.dropdown {
    position: relative;
}

.dropdown .dropbtn {
    background: none;
    border: none;
    color: white;
    font-size: 15px;
    padding: 10px 14px;
    cursor: pointer;
    border-radius: 6px;
}

/* MENU DROPDOWN */
.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 170px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 10;
    overflow: hidden; /* buang garis aneh bawah */
}

.dropdown-content a {
    padding: 10px 14px;
    color: #1b1f3b;
    display: block;
    text-decoration: none;
    font-size: 14px;
}

.dropdown-content a:hover {
    background: #f3eaff;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* USER INFO */
.user-info {
    margin-left: auto; /* dorong ke kanan */
    display: flex;
    align-items: center;
    gap: 12px; /* jarak antara nama & tombol logout */
    white-space: nowrap; /* biar tidak turun baris */
    color: white;
    font-size: 14px;
}

.user-info b {
    color: #d4c3ff;
}

/* LOGOUT */
.btn-logout {
    background: #7a3cff;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    font-size: 14px;
}

.btn-logout:hover {
    background: #5c2bbf;
}

/* CONTENT */
.container {
    padding: 20px;
}

/* ALERT */
.alert {
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
}

.alert-danger {
    background: #ffe4e4;
    color: #b20000;
    border: 1px solid #ffb3b3;
}

    </style>
</head>
<body>

<nav class="navbar">
  <a class="navbar-brand" href="home.php">Sistem Penjualan</a>
  <ul class="navbar-nav" style="display: flex; list-style: none; margin: 0; padding: 0;">
    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
    
    <?php if($_SESSION['level'] == 1) { ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropbtn">Data Master <span class="arrow-down">&#9660;</span></a>
      <div class="dropdown-content">
        <a href="home.php?page=barang">Data Barang</a>
        <a href="home.php?page=supplier">Data Supplier</a>
        <a href="home.php?page=pelanggan">Data Pelanggan</a>
        <a href="home.php?page=user">Data User</a>
      </div>
    </li>
    <?php } ?>

    <li class="nav-item"><a class="nav-link" href="home.php?page=transaksi">Transaksi</a></li>
    <li class="nav-item"><a class="nav-link" href="home.php?page=laporan">Laporan</a></li>
  </ul>

  <div class="user-info">
    <span>Halo, <b><?php echo $_SESSION['nama']; ?></b> 
    (<?php echo ($_SESSION['level'] == 1) ? "Owner" : "Kasir"; ?>)</span>
    <a href="authentikasi/logout.php" class="btn-logout">Logout</a>
  </div>
</nav>

<div class="container">
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "akses_ditolak"){
            echo "<div class='alert alert-danger' style='color:red; padding:10px; border:1px solid red; margin-bottom:10px;'>Akses Ditolak! Anda tidak memiliki izin.</div>";
        }
    }
    ?>

<?php 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        
        switch ($page) {
            case 'barang':
            case 'supplier':
            case 'pelanggan':
            case 'user':
                if($_SESSION['level'] != 1){
                    echo "<script>alert('Akses Ditolak! Anda bukan Owner.'); window.location='home.php';</script>";
                    exit;
                }
                include "Data_Master/$page.php"; 
                break;

            case 'transaksi':
                include 'transaksi/transaksi.php';
                break;
            case 'laporan':
                include 'laporan/laporan.php';
                break;
            default:
                echo "<center><h3>Maaf. Halaman tidak ditemukan!</h3></center>";
                break;
        }
    } else {

    }
?>
    
</div>

</body>
</html>