<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "penjualan");
$result = mysqli_query(
    $conn, "SELECT barang.id, barang.nama_barang, barang.harga, barang.stok,
    supplier.nama AS nama_supplier FROM barang INNER JOIN supplier 
    ON barang.supplier_id = supplier.id ORDER BY barang.id ASC");

if (!isset($_SESSION['user']) || !isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
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

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Data Barang</h2>

    <a href="../proses/barang/barang_tambah.php" class="btn btn-add">Tambah Barang</a>
    <a href="../owner.php" class="btn btn-back">Kembali</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supplier</th>
            <th>Tindakan</th>
        </tr>

        <?php 
        while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td><?= number_format($row['harga']); ?></td>
            <td><?= $row['stok']; ?></td>
            <td><?= $row['nama_supplier'] ?></td>
            <td>
                <a href="../proses/barang/barang_edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="../proses/barang/barang_hapus.php?id=<?= $row['id']; ?>" 
                   class="btn btn-delete"
                   onclick="return confirm('Yakin ingin menghapus barang ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>