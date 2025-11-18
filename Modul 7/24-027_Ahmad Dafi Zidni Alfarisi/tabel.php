<?php
include "conn.php";

$sql = "SELECT t.id, t.tanggal, p.nama AS nama_pelanggan, t.keterangan, t.total
        FROM transaksi t
        LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
        ORDER BY t.id ASC";

$data = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<style>
body { 
    font-family: Arial; 
    background:#f5f5f5;
    margin:0;
}


.card {
    background:white;
    padding:20px;
    border-radius:8px;
    border:1px solid #ddd;
    width:95%;
    margin:20px auto;
}

.section-title {
    background:green;
    color:white;
    padding:12px;
    border-radius:5px;
    font-size:18px;
}

.btn {
    padding:8px 12px;
    border-radius:5px;
    color:white;
    text-decoration:none;
    margin-left:5px;
}
.btn-report { background:orange; }
.btn-add { background:orange }
.btn-detail { background:orange; }
.btn-delete { background:red; }

table {
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}
th {
    background:green;
    color:white;
    border:1px solid #ddd;
    padding:10px;
}
td {
    border:1px solid #ddd;
    padding:8px;
}
</style>

</head>
<body>

<div class="card">

    <div class="section-title">Data Master Transaksi</div>

    <div style="margin-top:10px; margin-bottom:15px;">
        <a href="report_transaksi.php" class="btn btn-report">Lihat Laporan Penjualan</a>
        <a href="tambah_transaksi.php" class="btn btn-add">Tambah Transaksi</a>
    </div>

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
        while ($row = mysqli_fetch_assoc($data)): 
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row["id"] ?></td>
            <td><?= $row["tanggal"] ?></td>
            <td><?= $row["nama_pelanggan"] ?></td>
            <td><?= $row["keterangan"] ?></td>
            <td>Rp<?= number_format($row["total"],0,',','.') ?></td>
            <td>
                <a href="detail_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-detail">Lihat Detail</a>
                <a href="hapus_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-delete">Hapus</a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>
</div>

</body>
</html>
