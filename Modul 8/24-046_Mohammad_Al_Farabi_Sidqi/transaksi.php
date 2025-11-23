<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id='$id'");
    mysqli_query($conn, "DELETE FROM transaksi WHERE id='$id'");
    header("Location: transaksi.php");
    exit;
}

$detail_transaksi = null;
if (isset($_GET['lihat'])) {
    $id = $_GET['lihat'];
    $transaksi = mysqli_query($conn, "SELECT t.id, t.waktu_transaksi, p.nama_pelanggan
                                      FROM transaksi t
                                      LEFT JOIN pelanggan p ON t.pelanggan_id=p.id_pelanggan
                                      WHERE t.id='$id'");
    $detail_transaksi = mysqli_fetch_assoc($transaksi);

    $detail_barang = mysqli_query($conn, "SELECT b.nama_barang, td.qty, td.harga, (td.qty*td.harga) AS subtotal
                                          FROM transaksi_detail td
                                          LEFT JOIN barang b ON td.barang_id=b.id_barang
                                          WHERE td.transaksi_id='$id'");
}

$data_laporan = false;
$rekap = [];
$total = ['total_pelanggan' => 0, 'total_pendapatan' => 0];
if (isset($_POST['tampilkan'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $data_laporan = true;

    $sql_rekap = "SELECT DATE(t.waktu_transaksi) AS tanggal,
                  SUM(td.qty * td.harga) AS total
                  FROM transaksi t
                  LEFT JOIN transaksi_detail td ON td.transaksi_id=t.id
                  WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                  GROUP BY DATE(t.waktu_transaksi)
                  ORDER BY tanggal ASC";
    $rekap_result = mysqli_query($conn, $sql_rekap);
    while ($r = mysqli_fetch_assoc($rekap_result)) {
        $rekap[] = $r;
    }

    $total_result = mysqli_query($conn, "SELECT COUNT(DISTINCT t.id) AS total_pelanggan,
                                                SUM(td.qty*td.harga) AS total_pendapatan
                                         FROM transaksi t
                                         LEFT JOIN transaksi_detail td ON td.transaksi_id=t.id
                                         WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
    $total = mysqli_fetch_assoc($total_result);
}

$sql = "SELECT t.id, t.waktu_transaksi, p.nama_pelanggan,
        GROUP_CONCAT(b.nama_barang SEPARATOR ', ') AS keterangan,
        SUM(td.qty * td.harga) AS total
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id_pelanggan
        LEFT JOIN transaksi_detail td ON td.transaksi_id = t.id
        LEFT JOIN barang b ON td.barang_id = b.id_barang
        GROUP BY t.id
        ORDER BY t.waktu_transaksi DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transaksi & Laporan</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h2>Data Master Transaksi</h2>
        <a href="admin.php">
            <= Kembali ke Dashboard</a>

                <h3>Daftar Transaksi</h3>
                <table border="1" cellspacing="0" cellpadding="5">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Waktu Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['waktu_transaksi'] ?></td>
                            <td><?= $row['nama_pelanggan'] ?? '-' ?></td>
                            <td><?= $row['keterangan'] ?? '-' ?></td>
                            <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                            <td>
                                <a href="transaksi.php?lihat=<?= $row['id'] ?>"><button>Lihat</button></a>
                                <a href="transaksi.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus transaksi ini?')">
                                    <button>Hapus</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <?php if ($detail_transaksi): ?>
                    <hr>
                    <h3>Detail Transaksi #<?= $detail_transaksi['id'] ?></h3>
                    <p>Waktu: <?= $detail_transaksi['waktu_transaksi'] ?> | Pelanggan: <?= $detail_transaksi['nama_pelanggan'] ?></p>
                    <table border="1" cellspacing="0" cellpadding="5">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                        <?php $no = 1;
                        $total_detail = 0;
                        while ($d = mysqli_fetch_assoc($detail_barang)) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['nama_barang'] ?></td>
                                <td><?= $d['qty'] ?></td>
                                <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php $total_detail += $d['subtotal'];
                        } ?>
                        <tr>
                            <td colspan="4" style="text-align:right;"><b>Total</b></td>
                            <td><b>Rp <?= number_format($total_detail, 0, ',', '.') ?></b></td>
                        </tr>
                    </table>
                    <a href="transaksi.php">Tutup Detail Transaksi</a>
                <?php endif; ?>
    </div>

</body>

</html>