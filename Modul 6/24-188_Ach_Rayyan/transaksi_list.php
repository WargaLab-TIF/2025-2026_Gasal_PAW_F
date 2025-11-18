<?php
$conn = mysqli_connect("localhost", "root", "", "master-detail");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$res = mysqli_query(
    $conn,
    "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan 
     FROM transaksi t 
     LEFT JOIN pelanggan p ON p.id = t.pelanggan_id 
     ORDER BY t.id DESC"
);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Transaksi</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f5f5f5;
        }
        table {
            width: 95%;
            margin: 10px auto;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #f0f0f0;
        }
        a.btn {
            padding: 6px 8px;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center">Daftar Transaksi</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Waktu</th>
            <th>Keterangan</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php while ($r = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['waktu_transaksi'] ?></td>
            <td><?= htmlspecialchars($r['keterangan']) ?></td>
            <td><?= htmlspecialchars($r['pelanggan']) ?></td>
            <td><?= number_format($r['total'], 0, ',', '.') ?></td>
            <td>
                <a class="btn" href="transaksi_detail_list.php?transaksi_id=<?= $r['id'] ?>">
                    Lihat Detail
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

