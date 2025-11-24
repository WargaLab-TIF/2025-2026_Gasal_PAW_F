<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id']);
} else {
    die("ID Transaksi tidak ditemukan.");
}
$sql_header = "SELECT t.id, t.waktu_transaksi, p.nama AS nama_pelanggan, u.username AS nama_user, t.keterangan, t.total
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        LEFT JOIN user u ON t.id = u.id_user
        WHERE t.id = '$id_transaksi'";

$result_header = mysqli_query($koneksi, $sql_header);

if (!$result_header || mysqli_num_rows($result_header) == 0) {
    die("Transaksi ID #{$id_transaksi} tidak ditemukan.");
}

$header = mysqli_fetch_assoc($result_header);
$nama_pelanggan = !empty($header['nama_pelanggan']) ? htmlspecialchars($header['nama_pelanggan']) : 'Umum';
$tanggal_waktu = date('d/m/Y', strtotime($header['waktu_transaksi']));

$sql_detail = "SELECT td.qty, td.harga,(td.qty * td.harga) AS subtotal_item, b.nama_barang
        FROM transaksi_detail td
        JOIN barang b ON td.barang_id = b.id
        WHERE td.transaksi_id = '$id_transaksi'";

$result_detail = mysqli_query($koneksi, $sql_detail);

if (!$result_detail) {
    die("Query detail gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Penjualan #<?php echo $id_transaksi; ?></title>
    
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>
<body style="font-family: monospace; font-size: 11px; max-width: 300px; margin: auto; padding: 10px;">

<div align="center">
    <h3>TOSERBA</h3>
    <p>Jl. Raya Telang, Bangkalan, Jawa Timur</p>
    <p>Telp: 08512345678</p>
</div>
<hr size="1">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="30%">Faktur No.</td>
        <td width="70%">: TR-<?php echo $id_transaksi; ?></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>: <?php echo $tanggal_waktu; ?></td>
    </tr>
    <tr>
        <td>Kasir</td>
        <td>: <?php echo htmlspecialchars($header['nama_user']); ?></td>
    </tr>
    <tr>
        <td>Pelanggan</td>
        <td>: <?php echo $nama_pelanggan; ?></td>
    </tr>
</table>
<hr size="1">

<table width="100%" border="0" cellpadding="2" cellspacing="0">
    <thead>
        <tr>
            <td width="5%" align="center">QTY</td>
            <td width="50%">NAMA BARANG</td>
            <td width="20%" align="right">HARGA</td>
            <td width="25%" align="right">TOTAL</td>
        </tr>
    </thead>
    <tbody>
    <?php
    $grand_total_detail = 0; 

    if (mysqli_num_rows($result_detail) > 0) {
        while ($d = mysqli_fetch_assoc($result_detail)) {
            $subtotal_numerik = $d['subtotal_item'];
            $grand_total_detail += $subtotal_numerik;

            $harga_satuan = number_format($d['harga'], 0, ',', '.');
            $subtotal = number_format($subtotal_numerik, 0, ',', '.');

            echo "
            <tr>
                <td align='center'>{$d['qty']}</td>
                <td>" . htmlspecialchars($d['nama_barang']) . "</td>
                <td align='right'>{$harga_satuan}</td>
                <td align='right'>{$subtotal}</td>
            </tr>";
        }
    }
    ?>
    </tbody>
</table>
<hr size="1">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr>
        <td width="75%" align="right">TOTAL BAYAR (Rp)</td>
        <td width="25%" align="right"><?php echo number_format($grand_total_detail, 0, ',', '.'); ?></td>
    </tr>
    </table>

<hr size="1">

<div align="center">
    <p>--- Terima Kasih Telah Berbelanja ---</p>
    <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
</div>
</body>
</html>