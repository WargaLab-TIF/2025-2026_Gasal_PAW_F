<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id']);
} else {
    header("Location: transaksi.php");
    exit;
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
$waktu = date('d/m/Y', strtotime($header['waktu_transaksi']));

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
    <title>Detail Transaksi <?php echo $id_transaksi; ?></title>
</head>
<body style="font-family: Arial, sans-serif;">

<table width="100%" bgcolor="black" cellpadding="10">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="transaksi.php" style="color:white; text-decoration:none;"><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>

<div style="padding: 20px;">
    <h1 align="center">DETAIL TRANSAKSI PENJUALAN <?php echo $id_transaksi; ?></h1>

    <table width="50%" border="0" cellpadding="5">
        <tr>
            <td width="20%">Tanggal</td>
            <td width="1%">:</td>
            <td><?php echo $waktu; ?></td>
        </tr>
        <tr>
            <td>Kasir/User</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($header['nama_user']); ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>:</td>
            <td><?php echo $nama_pelanggan; ?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($header['keterangan']); ?></td>
        </tr>
    </table>

    <hr size="1" width="50%" align="left">
    
    <h2>Daftar Barang</h2>

    <table border="1" cellpadding="8" width="50%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="20%">Nama Barang</th>
                <th width="7%">Qty</th>
                <th width="15%">Harga Satuan</th>
                <th width="15%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $grand_total_detail = 0; 

        if (mysqli_num_rows($result_detail) > 0) {
            while ($d = mysqli_fetch_assoc($result_detail)) {
                $subtotal_numerik = $d['subtotal_item'];
                $grand_total_detail += $subtotal_numerik;

                $harga_satuan = "Rp " . number_format($d['harga'], 0, ',', '.');
                $subtotal = "Rp " . number_format($subtotal_numerik, 0, ',', '.');

                echo "
                <tr>
                    <td align='center'>{$no}.</td>
                    <td>" . htmlspecialchars($d['nama_barang']) . "</td>
                    <td align='center'>{$d['qty']}</td>
                    <td align='right'>{$harga_satuan}</td>
                    <td align='right'>{$subtotal}</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='5' align='center'>Tidak ada item barang dalam transaksi ini.</td></tr>";
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" align="right">TOTAL BAYAR</td>
                <td align="right">Rp <?php echo number_format($grand_total_detail, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>

    <br>
    <a href="cetak_transaksi.php?id=<?php echo $id_transaksi; ?>" 
    style="background-color: orange; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-right: 5px; margin-left: 10px;">
        <b>Cetak Resi</b>
    </a>
    &nbsp;&nbsp;
    <a href="hapus_transaksi.php?id=<?php echo $id_transaksi; ?>" 
        onclick="return confirm('Yakin menghapus Transaksi ID <?php echo $id_transaksi; ?>?');"
        style="background-color: red; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-right: 5px; margin-left: 10px;">
        <b>Hapus Transaksi</b>
    </a>
</div>
</body>
</html>