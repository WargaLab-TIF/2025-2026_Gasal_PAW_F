<?php
    session_start();

    if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
        header("Location: ../../login.php");
        exit;
    }

    $nama_user = $_SESSION['username'];

    include "../../koneksi.php";

    $sql = "SELECT * FROM barang";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/barang/indexStyle.css">
    <title>Dashboard Data Barang</title>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            <a href="../home.php" class="nav-item">Home</a>
            
            <select onchange="window.location.href=this.value" class="nav-select">
                <option value="barang.php">Data Barang</option>
                <option value="../supplier/supplier.php">Data Supplier</option>
                <option value="pelanggan.php">Data Pelanggan</option>
                <option value="../user/user.php">Data User</option>
            </select>


            <a href="transaksi.php" class="nav-item">Transaksi</a>
            <a href="laporan.php" class="nav-item">Laporan</a>
        </div>

        <div class="nav-right">
            <select onchange="window.location.href=this.value" class="nav-select">
                <option><?= $nama_user ?></option>
                <option value="../../logout.php">Logout</option>
            </select>
        </div>
    </nav>
    <div class="header-container">
        <h1>Data Barang</h1>
        <button type="button" class="btn-tambah" onclick="window.location.href='create.php'">Tambah Data</button>
    </div>

    <div class="container">
        <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier ID</th>
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
                    <td><?= htmlspecialchars($row['kode_barang']) ?></td>
                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row['stok']) ?></td>
                    <td><?= htmlspecialchars($row['supplier_id']) ?></td>
                    <td>
                        <button type="button" class="btn-edit" onclick="window.location.href='edit.php?id=<?= $row['id'] ?>'">Edit</button>
                        <button type="button" class="btn-hapus" onclick="if (confirm('Yakin ingin menghapus barang <?= $row['nama_barang'] ?>?')) { window.location.href='delete.php?id=<?= $row['id'] ?>'; }">Hapus</button>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    </div>
</body>
</html>