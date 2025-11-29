<?php
// user.php
include "conn.php";
include "cek_session.php"; // Wajib login

// Cek Level: Jika Admin masuk sini, boleh saja, atau mau di redirect ke admin.php juga bisa.
// Disini kita biarkan saja.
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background-color: #eef2f3; }
        nav { background-color: #007bff; overflow: hidden; }
        nav a { float: left; display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none; }
        nav a:hover { background-color: #0056b3; }
        
        .container { padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 600px; margin-top: 20px;}
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>

<nav>
    <a href="user.php">Home</a>
    <a href="transaksi.php">Transaksi</a>
    <a href="laporan.php">Laporan</a>
    <a href="logout.php" style="float:right; background-color: #dc3545;">Logout</a>
</nav>

<div class="container">
    <h1>Dashboard Pegawai</h1>
    <div class="card">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h2>
        <p>Anda login sebagai <strong>User / Pegawai</strong>.</p>
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