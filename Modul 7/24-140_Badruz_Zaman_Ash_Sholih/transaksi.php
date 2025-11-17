<?php
require_once "./Core/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    <div class="nav-top">
        <button class="nav-btn" onclick="alert('Hanya Tampilan')" >Supplier</button>
        <button class="nav-btn" onclick="alert('Hanya Tampilan')">Barang</button>
        <button class="nav-btn" onclick="location.href='transaksi.php'">Transaksi</button>
    </div>

    <h2>Data Master Transaksi</h2>

    <button class="btn-report" onclick="location.href='report_transaksi.php'">Lihat Laporan Penjualan</button>
    <button class="btn-add" onclick="alert('Hanya Tampilan')">Tambah Transaksi</button>


    <br><br>

    <table class="tabel">
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
        $q = mysqli_query($conn, "
        SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
        FROM transaksi
        INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
        ORDER BY transaksi.id ASC
    ");

        $no = 1;
        while ($row = mysqli_fetch_assoc($q)):
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id'] ?></td>
                <td><?= $row['waktu_transaksi'] ?></td>
                <td><?= $row['nama_pelanggan'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td>Rp <?= number_format($row['total']) ?></td>

                <td>
                    <button class="btn-detail"
                        onclick="alert('Hanya Tampilan')">
                        Lihat Detail
                    </button>


                    <button class="btn-delete"
                        onclick="alert('Hanya Tampilan')">
                        Hapus
                    </button>

                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>