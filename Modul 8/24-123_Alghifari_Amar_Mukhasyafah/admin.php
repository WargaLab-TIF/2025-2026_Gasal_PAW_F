<?php
// admin.php
include "conn.php";
include "cek_session.php"; // Wajib login

// Cek Level: Jika bukan admin (level 1), tendang ke halaman user atau logout
if ($_SESSION['level'] != 1) {
    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        /* Navbar Styling */
        nav { background-color: #333; overflow: hidden; }
        nav a { float: left; display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none; }
        nav a:hover, .dropdown:hover .dropbtn { background-color: #ddd; color: black; }
        
        /* Dropdown Styling */
        .dropdown { float: left; overflow: hidden; }
        .dropdown .dropbtn { font-size: 16px; border: none; outline: none; color: white; padding: 14px 16px; background-color: inherit; font-family: inherit; margin: 0; cursor: pointer;}
        .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; }
        .dropdown-content a { float: none; color: black; padding: 12px 16px; text-decoration: none; display: block; text-align: left; }
        .dropdown-content a:hover { background-color: #ddd; }
        .dropdown:hover .dropdown-content { display: block; }
        
        .container { padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 600px; margin-top: 20px;}
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>

<nav>
    <a href="admin.php">Home</a>
    
    <div class="dropdown">
        <button class="dropbtn">Data Master ▼</button>
        <div class="dropdown-content">
            <a href="barang.php">Data Barang</a>
            <a href="supplier.php">Data Supplier</a>
            <a href="pelanggan.php">Data Pelanggan</a>
            <a href="user_management.php">Data User</a>
        </div>
    </div> 
    
    <a href="transaksi.php">Transaksi</a>
    <a href="laporan.php">Laporan</a>
    <a href="logout.php" style="float:right; background-color: #d9534f;">Logout</a>
</nav>

<div class="container">
    <h1>Dashboard Admin</h1>
    <div class="card">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h2>
        <p>Anda login sebagai <strong>Administrator</strong>.</p>
        <hr>
        <h3>Informasi Akun Anda:</h3>
        <table>
            <tr>
                <td>Username</td>
                <td>: <?php echo $_SESSION['username']; ?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>: <?php echo $_SESSION['nama']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: <?php echo $_SESSION['alamat']; ?></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>: <?php echo $_SESSION['hp']; ?></td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>