<?php
    session_start();

    // Cek sudah login?
    if (!isset($_SESSION['login']) || $_SESSION['login'] != true || $_SESSION['level'] != 1) {
        header("Location: ../../login.php");
        exit;
    }

    $nama_user = $_SESSION['username'];

    include "../../koneksi.php";

    $sql = "SELECT * FROM transaksi";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/transaksi/indexStyle.css">
    <title>Dashboard Data Transaksi</title>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            <a href="../home.php" class="nav-item">Home</a>
            
            <select onchange="window.location.href=this.value" class="nav-select">
                <option>Data Mater</option>
                <option value="../pelanggan/pelanggan.php">Data Pelanggan</option>
                <option value="../supplier/supplier.php">Data Supplier</option>
                <option value="../barang/barang.php">Data Barang</option>
                <option value="../user/user.php">Data User</option>
            </select>


            <a href="transaksi.php" class="nav-item">Transaksi</a>
            <a href="../laporan/report_transaksi.php" class="nav-item">Laporan</a>
        </div>

        <div class="nav-right">
            <select onchange="window.location.href=this.value" class="nav-select">
                <option><?= $nama_user ?></option>
                <option value="../../logout.php">Logout</option>
            </select>
        </div>
    </nav>
    <div class="header-container">
        <h1>Data Transaksi</h1>
        <button type="button" class="btn-tambah" onclick="window.location.href='create.php'">Tambah Data</button>
    </div>

    <div class="container">
        <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Pelanggan id</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                foreach($result as $row): 
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= date('d-m-Y', strtotime($row['waktu_transaksi'])) ?></td>
                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row['pelanggan_id']) ?></td>
                    <td>
                        <button type="button" class="btn-edit" onclick="window.location.href='edit.php?id=<?= $row['id'] ?>'">Edit</button>
                        <button type="button" class="btn-hapus" onclick="if (confirm('Yakin ingin menghapus data transaksi ini?')) { window.location.href='delete.php?id=<?= $row['id'] ?>'; }">Hapus</button>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    </div>
</body>
</html>