<?php
session_start();

// Cek sudah login?
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: ./login.php");
    exit;
}

// Ambil nama user dari session, jika tidak ada gunakan default 'Admin'
$nama_user = $_SESSION['username'];

include "../koneksi.php";

$sql = "SELECT * FROM user";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/indexStyle.css">
    <title>Dashboard Data User</title>
</head>

<body>

    <nav class="navbar">
        <div class="nav-left">
            <a href="home.php" class="nav-item">Home</a>
            <a href="transaksi/transaksi.php" class="nav-item">Transaksi</a>
            <a href="laporan/report_transaksi.php" class="nav-item">Laporan</a>
        </div>

        <div class="nav-right">
            <select onchange="window.location.href=this.value" class="nav-select">
                <option><?= $nama_user ?></option>
                <option value="../logout.php">Logout</option>
            </select>
        </div>
    </nav>
    <div class="header-container">
        <h1>Halo <?= $nama_user ?></h1>
    </div>
</body>

</html>