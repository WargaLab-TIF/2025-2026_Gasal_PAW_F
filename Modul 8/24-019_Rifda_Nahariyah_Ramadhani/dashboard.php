<?php 
session_start();

if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit();
}

$nama_user = $_SESSION['nama_user'];
$level = $_SESSION['level'];

$navigasi_master = '';
if ($level == 1) {
    $navigasi_master = '
        <details style="display:inline-block; margin:0 15px; color:white;">
            <summary style="list-style:none; cursor:pointer; color:white; display:flex; align-items:center; font-weight:bold;">
                <span>Data Master</span>
                <span style="font-size:12px;">&#9656;</span>
            </summary>
            <div>
                <div><a href="data_barang.php" style="color:white; text-decoration:none;">Data Barang</a></div>
                <div><a href="data_supplier.php" style="color:white; text-decoration:none;">Data Supplier</a></div>
                <div><a href="data_pelanggan.php" style="color:white; text-decoration:none;">Data Pelanggan</a></div>
                <div><a href="data_user.php" style="color:white; text-decoration:none;">Data User</a></div>
            </div>

        </details>
    ';
}
$role = '';
if ($level == 1) {
    $role = 'Admin/Supervisor';
} elseif ($level == 2) {
    $role = 'Kasir/gudang';
}else {
    $role = 'Pengguna';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .navbar { background-color: #333; color: white; padding: 10px 0; }
        .navbar-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .nav-list { list-style: none; display: flex; padding: 0; }
        .nav-list a { color: white; text-decoration: none; padding: 8px 15px; }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-container">
        <ul class="nav-list">
            <li><a href="dashboard.php"><b>Home</b></a></li>
            <?php echo $navigasi_master; ?>
            <li><a href="transaksi.php"><b>Transaksi</b></a></li>
            <li><a href="laporan.php"><b>Laporan</b></a></li>
        </ul>
        
        <ul class="nav-list">
            <li><?php echo htmlspecialchars($nama_user); ?></li>
            <li><a href="logout.php"><b>Logout</b></a></li>
        </ul>
    </div>
</div>
<div style="padding: 20px;">
    <h1>Selamat Datang</h1>
    <p>Halo <?php echo htmlspecialchars($nama_user); ?>, Anda berhasil masuk sebagai  <?php echo $role; ?>  (Level <?php echo $level; ?>).
    </p>
    <hr>
    
    <table border="0"  cellspacing="0" width="80%">
        <tr>
            <td colspan="2">Gunakan menu navigasi di atas untuk mengakses fitur sistem:</td>
        </tr>
        <tr>
            <td width="15%">
                <p><b>Data Master:</b></p>
            </td>
            <td>
                <p>Kelola data utama seperti Barang, Pelanggan, dan User (hanya tersedia untuk level tertentu).</p>
            </td>
        </tr>
        <tr>
            <td width="15%">
                <p><b>Transaksi:</b></p>
            </td>
            <td>
                <p>Melakukan transaksi penjualan baru atau melihat Daftar Transaksi yang sudah tercatat.</p>
            </td>
        </tr>
        <tr>
            <td width="15%">
                <p><b>Laporan:</b></p>
            </td>
            <td>
                <p>Melihat dan mencetak ringkasan laporan penjualan berdasarkan periode waktu.</p>
            </td>
        </tr>
    </table>
    <?php if ($level == 2): ?>
        <hr>
        <p>Anda dapat langsung menuju halaman transaksi penjualan untuk melayani pelanggan.</p>
        <a href="transaksi_baru.php">
            <button type="button" style="padding: 10px 15px; background-color: limegreen; color: white; text-decoration: none; border-radius: 4px; border-color: limegreen;">
                <b>Mulai Transaksi Baru</b>
            </button>
        </a>
    <?php endif; ?>
</body>
</html>