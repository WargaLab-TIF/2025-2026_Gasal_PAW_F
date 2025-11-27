<?php
include '../koneksi.php';

// Validasi ID
$id_transaksi = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id_transaksi <= 0) {
    die("ID Transaksi tidak valid.");
}

// ===============================
// Query Data Transaksi (Biasa)
// ===============================
$query_transaksi = "
    SELECT t.*, p.nama AS nama_pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    WHERE t.id = $id_transaksi
";
$result = mysqli_query($conn, $query_transaksi);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data Transaksi tidak ditemukan.");
}

// ===============================
// Query Detail Transaksi (Biasa)
// ===============================
$query_detail = "
    SELECT td.*, b.nama_barang, b.harga
    FROM transaksi_detail td
    LEFT JOIN barang b ON td.barang_id = b.id
    WHERE td.transaksi_id = $id_transaksi
";
$result_detail = mysqli_query($conn, $query_detail);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Resi #<?= $id_transaksi ?></title>
    <style>
        body { 
            font-family: 'Consolas', monospace;
            width: 300px;
            margin: auto;
            padding: 10px;
        }
        h3 { text-align: center; margin: 5px 0; }
        hr { border: 1px dashed #000; margin: 10px 0; }
        .info-header { font-size: 14px; margin-bottom: 10px; }
        .info-header p { margin: 2px 0; }
        table { width: 100%; font-size: 14px; border-collapse: collapse; }
        td { padding: 3px 0; }
        .left { text-align: left; }
        .right { text-align: right; }
        .center { text-align: center; }
        .total-line { font-weight: bold; font-size: 16px; padding-top: 5px; }
        @media print {
            body { margin: 0; padding: 0; }
            @page { size: 80mm auto; }
        }
    </style>
</head>
<body onload="window.print()">

<h3>TOKO SERBA ADA</h3>
<div class="center" style="margin-bottom: 10px;">
    <small>Jl. Trisula No. 1, Kota Blitar</small>
</div>
<hr>

<div class="info-header">
    <p>Tanggal: <?= date('d-m-Y H:i:s', strtotime($data['waktu_transaksi'])) ?></p>
    <p>Resi ID: #<?= $data['id'] ?></p>
    <p>Pelanggan: <?= htmlspecialchars($data['nama_pelanggan'] ?: 'Umum') ?></p>
    <p>Keterangan: <?= htmlspecialchars($data['keterangan']) ?></p>
</div>

<hr>

<table>
    <?php while ($row = mysqli_fetch_assoc($result_detail)) : 
        $harga_satuan = $row['harga'];
        $qty = $row['qty'];
        $subtotal = $harga_satuan * $qty;
    ?>
    <tr>
        <td class="left"><?= htmlspecialchars($row['nama_barang']) ?></td>
        <td class="right"><?= number_format($harga_satuan, 0, ',', '.') ?></td>
    </tr>
    <tr>
        <td class="left" style="padding-left: 10px;"><?= $qty ?> x</td>
        <td class="right">Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<hr>

<table>
    <tr>
        <td class="left total-line">TOTAL BAYAR</td>
        <td class="right total-line">Rp<?= number_format($data['total'], 0, ',', '.') ?></td>
    </tr>
</table>

<p style="text-align:center; margin-top:20px; font-size: 14px;">
--- Terima kasih telah berbelanja ---<br>
</p>

</body>
</html>
