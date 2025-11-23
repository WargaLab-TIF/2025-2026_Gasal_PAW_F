<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$transaksi_id = $_GET['id'];

$query = "
SELECT transaksi_detail.*, barang.nama_barang, barang.harga AS harga_satuan
FROM transaksi_detail 
INNER JOIN barang ON transaksi_detail.barang_id = barang.id
WHERE transaksi_detail.transaksi_id = $transaksi_id
";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <style>
        body {
            margin: 0;
            font-family: Verdana, sans-serif;
            background: #f0f2f5;
            padding: 30px 0;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 900px;
            background: #fff;
            padding: 25px 28px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        h2 {
            margin: 0 0 18px;
            text-align: center;
            color: #333;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .btn {
            background: #007bff;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #005ec2;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-back:hover {
            background: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 14px;
        }

        table th {
            background: #007bff;
            color: white;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Transaksi</h2>

        <div class="actions">
            <a href="tambah_transaksi_detail.php?transaksi_id=<?= $transaksi_id ?>" class="btn">
                Tambah Detail Transaksi
            </a>

            <a href="transaksi.php" class="btn btn-back">Kembali</a>
        </div>

        <table>
            <tr>
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Qty</th>
            </tr>
            <?php while ($d = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $d['transaksi_id'] ?></td>
                    <td><?= $d['nama_barang'] ?></td>
                    <td><?= number_format($d['harga_satuan']) ?></td>
                    <td><?= $d['qty'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>