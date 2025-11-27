<?php
$conn = mysqli_connect("localhost", "root", "", "master-detail");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$transaksi_id = intval($_GET['transaksi_id'] ?? 0);

if ($transaksi_id > 0) {
    $query = "
        SELECT td.id, b.nama AS barang, td.qty, td.subtotal 
        FROM transaksi_detail td 
        LEFT JOIN barang b ON b.id = td.barang_id 
        WHERE td.transaksi_id = $transaksi_id
    ";
} else {
    $query = "
        SELECT td.id, td.transaksi_id, b.nama AS barang, td.qty, td.subtotal 
        FROM transaksi_detail td 
        LEFT JOIN barang b ON b.id = td.barang_id 
        ORDER BY td.transaksi_id DESC
    ";
}

$res = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Daftar Transaksi Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 95%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #f0f0f0;
        }
        tr:nth-child(even) {
            background: #fafafa;
        }
        tr:hover {
            background: #e9f3ff;
        }
    </style>
</head>
<body>
    <h2>
        Daftar Transaksi Detail 
        <?= $transaksi_id ? "(Transaksi #$transaksi_id)" : "" ?>
    </h2>

    <table>
        <tr>
            <?php if (!$transaksi_id): ?>
                <th>Transaksi ID</th>
            <?php endif; ?>
            <th>Barang</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>

        <?php while ($r = mysqli_fetch_assoc($res)): ?>
            <tr>
                <?php if (!$transaksi_id): ?>
                    <td><?= htmlspecialchars($r['transaksi_id']) ?></td>
                <?php endif; ?>
                <td><?= htmlspecialchars($r['barang']) ?></td>
                <td><?= $r['qty'] ?></td>
                <td><?= number_format($r['subtotal'], 0, ',', '.') ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
