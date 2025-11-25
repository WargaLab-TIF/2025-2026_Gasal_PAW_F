<?php
include 'koneksi.php';

$transaksi_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($transaksi_id == 0) {
    die("ID Transaksi tidak valid.");
}

// Query Transaksi Utama
$sql_utama = "
    SELECT 
        t.id, t.waktu_transaksi, t.keterangan, t.total,
        p.nama AS nama_pelanggan
    FROM 
        transaksi t
    JOIN 
        pelanggan p ON t.pelanggan_id = p.id
    WHERE 
        t.id = ?
";
$stmt_utama = $koneksi->prepare($sql_utama);
$stmt_utama->bind_param("i", $transaksi_id);
$stmt_utama->execute();
$result_utama = $stmt_utama->get_result();
$transaksi = $result_utama->fetch_assoc();
$stmt_utama->close();

if (!$transaksi) {
    die("Data transaksi tidak ditemukan.");
}

// Query Detail Transaksi
$sql_detail = "
    SELECT 
        td.qty, td.harga, td.qty * td.harga AS subtotal,
        b.nama_barang
    FROM 
        transaksi_detail td
    JOIN 
        barang b ON td.barang_id = b.id
    WHERE 
        td.transaksi_id = ?
";
$stmt_detail = $koneksi->prepare($sql_detail);
$stmt_detail->bind_param("i", $transaksi_id);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();
$stmt_detail->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Detail Transaksi #<?php echo $transaksi_id; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="content-container" style="max-width: 800px;">
        <h2>Detail Transaksi #<?php echo $transaksi_id; ?></h2>

        <table class="table table-bordered mb-4">
            <tr>
                <th>Tanggal</th>
                <td><?php echo date('d M Y', strtotime($transaksi['waktu_transaksi'])); ?></td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td><?php echo $transaksi['nama_pelanggan']; ?></td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td><?php echo $transaksi['keterangan']; ?></td>
            </tr>
            <tr>
                <th>Total Bayar</th>
                <td><?php echo formatRupiah($transaksi['total']); ?></td>
            </tr>
        </table>

        <h4>Detail Barang</h4>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1;
                $grand_total_detail = 0;
                while ($d = $result_detail->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $n++; ?></td>
                        <td><?php echo $d['nama_barang']; ?></td>
                        <td><?php echo formatRupiah($d['harga']); ?></td>
                        <td><?php echo $d['qty']; ?></td>
                        <td><?php echo formatRupiah($d['subtotal']);
                            $grand_total_detail += $d['subtotal']; ?></td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <th colspan="4" class="text-right">Grand Total</th>
                    <th><?php echo formatRupiah($grand_total_detail); ?></th>
                </tr>
            </tbody>
        </table>

        <a href="data_master_transaksi.php" class="btn btn-secondary">Kembali ke Master</a>
    </div>
</body>

</html>