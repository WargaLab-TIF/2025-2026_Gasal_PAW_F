<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "penjualan");
$result = mysqli_query(
    $conn, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id ORDER BY transaksi.id ASC");

if (!isset($_SESSION['user']) || !isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: verdana;
            background: #f1f3f6;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .container {
            width: 80%;
            background: white;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #007BFF;
            color: white;
            padding: 10px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background: #f0f8ff;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-add {
            background: #28a745;
            margin-bottom: 15px;
            display: inline-block;
        }

        .btn-back {
            background: #0021faff;
            margin-bottom: 15px;
        }

        .btn-detail {
            background: #ff9c07ff;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Data Transaksi</h2>

    <a href="../transaksi/tambah_transaksi.php" class="btn btn-add">Tambah Transaksi</a>
    <a href="<?= $_SESSION['level'] == 1 ? '../owner.php' : '../kasir.php' ?>" class="btn btn-back">Kembali</a>

    <table>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Tindakan</th>
        </tr>

        <?php 
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['waktu_transaksi'] ?></td>
            <td><?= $row['nama_pelanggan'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td>Rp <?= number_format($row['total']) ?></td>
            <td>
                <a href="./transaksi_detail.php?id=<?= $row['id']; ?>" class="btn btn-detail">Lihat Detail</a>
                <a href="./transaksi_hapus.php?id=<?= $row['id']; ?>" 
                   class="btn btn-delete"
                   onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>