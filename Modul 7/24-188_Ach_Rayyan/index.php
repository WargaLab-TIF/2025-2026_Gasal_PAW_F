<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Master Transaksi - Index</title>
    <style>
        body{font-family:Arial;margin:20px;background:#f4f7fb}
        .card{background:#fff;padding:14px;border-radius:8px;border:1px solid #e6eef9;max-width:1100px;margin:0 auto}
        table{width:100%;border-collapse:collapse}
        th,td{padding:8px;border:1px solid #e6eef9;text-align:left}
        th{background:#e9f5ff;color:#007bff}
        .actions{display:flex;gap:8px}
        .btn{padding:8px 12px;border-radius:6px;text-decoration:none;color:#fff;background:#0d6efd}
        .btn-green{background:#198754}
    </style>
</head>
<body>
<div class="card">
    <h2>Penjualan XYZ — Data Transaksi</h2>
    <div style="display:flex;justify-content:space-between;align-items:center">
        <div>
            <a href="transaksi_form.php" class="btn">Tambah Transaksi</a>
            <a href="laporan_penjualan.php" class="btn btn-green">Laporan Penjualan</a>
        </div>
    </div>

    <hr>

    <div style="overflow:auto">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Waktu Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $q = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
            if (!$q) {
                echo "<tr><td colspan='7'>Query error: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($q)) {
                    $id = (int)$row['id_transaksi'];
                    $tgl = htmlspecialchars($row['waktu_transaksi']);
                    $nama = htmlspecialchars($row['nama_pelanggan']);
                    $ket = htmlspecialchars($row['keterangan']);
                    $total = 'Rp' . number_format($row['total'],0,',','.');
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$id}</td>
                        <td>{$tgl}</td>
                        <td>{$nama}</td>
                        <td>{$ket}</td>
                        <td>{$total}</td>
                        <td>
                            <div class='actions'>
                                <a style='background:#17a2b8;padding:6px 10px;border-radius:6px;color:#fff;text-decoration:none' href='detail_transaksi.php?id={$id}'>Lihat</a>
                                <a style='background:#dc3545;padding:6px 10px;border-radius:6px;color:#fff;text-decoration:none' href='transaksi_delete.php?id={$id}' onclick=\"return confirm('Hapus transaksi ID {$id}?')\">Hapus</a>
                            </div>
                        </td>
                    </tr>";
                    $no++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
