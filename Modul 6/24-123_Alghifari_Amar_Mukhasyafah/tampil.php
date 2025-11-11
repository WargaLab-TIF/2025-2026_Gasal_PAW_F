<?php
include 'core/conn.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjualan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #028090;
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #00a896;
            color: white;
        }
        tr:nth-child(even) { background-color: #f9f9f9; }
        a.btn {
            background: #00a896;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }
        a.btn:hover {
            background: #028090;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        hr {
            border: none;
            border-top: 2px solid #ccc;
            margin: 40px 0;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>🛒 Sistem Penjualan - Master Detail</h1>
    <a href="tambah_transaksi_detail.php" class="btn">+ Tambah Detail Transaksi</a>

    <!-- Tabel Barang -->
    <!-- Tabel Barang -->
<h2>Daftar Barang</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Action</th>
    </tr>
    <?php
    $barang = mysqli_query($conn, "SELECT * FROM barang");
    while ($b = mysqli_fetch_assoc($barang)) {
        echo "<tr>
                <td>{$b['id']}</td>
                <td>{$b['nama_barang']}</td>
                <td>Rp" . number_format($b['harga']) . "</td>
                <td>{$b['stok']}</td>
                <td>
                    <a class='btn' href='hapus_barang.php?id={$b['id']}'
                       onclick=\"return confirm('Yakin ingin menghapus barang ini?')\">Hapus</a>
                </td>
              </tr>";
    }
    ?>
</table>


    <hr>

    <!-- Tabel Transaksi -->
    <h2>Data Transaksi</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Waktu Transaksi</th>
            <th>Pelanggan</th>
            <th>Keterangan</th>
            <th>Total (Rp)</th>
        </tr>
        <?php
        $transaksi = mysqli_query($conn, "
            SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan
            FROM transaksi t
            JOIN pelanggan p ON t.pelanggan_id = p.id
            ORDER BY t.id ASC
        ");
        while ($t = mysqli_fetch_assoc($transaksi)) {
            echo "<tr>
                    <td>{$t['id']}</td>
                    <td>{$t['waktu_transaksi']}</td>
                    <td>{$t['pelanggan']}</td>
                    <td>{$t['keterangan']}</td>
                    <td><strong>Rp" . number_format($t['total']) . "</strong></td>
                  </tr>";
        }
        ?>
    </table>

    <hr>

    <!-- Tabel Transaksi Detail -->
    <h2>Detail Transaksi</h2>
    <table>
        <tr>
            <th>ID Transaksi</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga Total</th>
        </tr>
        <?php
        $detail = mysqli_query($conn, "
            SELECT td.transaksi_id, b.nama_barang, td.qty, td.harga
            FROM transaksi_detail td
            JOIN barang b ON td.barang_id = b.id
            ORDER BY td.transaksi_id
        ");
        while ($d = mysqli_fetch_assoc($detail)) {
            echo "<tr>
                    <td>{$d['transaksi_id']}</td>
                    <td>{$d['nama_barang']}</td>
                    <td>{$d['qty']}</td>
                    <td>Rp" . number_format($d['harga']) . "</td>
                  </tr>";
        }
        ?>
    </table>

</div>
</body>
</html>
