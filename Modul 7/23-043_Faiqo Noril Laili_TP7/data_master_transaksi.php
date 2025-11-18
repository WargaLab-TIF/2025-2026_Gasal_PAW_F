<?php
session_start();
include 'koneksi.php';

$sql_transaksi = "
    SELECT 
        t.id, 
        t.waktu_transaksi, 
        p.nama AS nama_pelanggan, 
        t.keterangan, 
        t.total
    FROM 
        transaksi t
    JOIN 
        pelanggan p ON t.pelanggan_id = p.id
    ORDER BY 
        t.id DESC
";
$result_transaksi = $koneksi->query($sql_transaksi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="header-nav">
        <div class="brand">Penjualan XYZ</div>
        <div class="menu">
            <a href="#">Supplier</a>
            <a href="#">Barang</a>
            <a href="#">Transaksi</a>
        </div>
    </div>

    <div class="content-container">

        <?php
        if (isset($_SESSION['delete_message'])):
            $alert_class = $_SESSION['delete_success'] ? 'alert-success' : 'alert-danger';
        ?>
            <div class="alert <?php echo $alert_class; ?>" role="alert">
                <?php echo $_SESSION['delete_message']; ?>
            </div>
        <?php
            unset($_SESSION['delete_message']);
            unset($_SESSION['delete_success']);
        endif;
        ?>

        <div class="data-master-header">
            Data Master Transaksi
        </div>

        <div class="action-buttons">
            <a href="report_transaksi.php" class="btn btn-info">
                Lihat Laporan Penjualan
            </a>
            <a href="tambah_transaksi.php" class="btn btn-success">
                Tambah Transaksi
            </a>
        </div>

        <table class="table table-bordered table-striped table-transaksi">
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
                if ($result_transaksi && $result_transaksi->num_rows > 0):
                    while ($row = $result_transaksi->fetch_assoc()):
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['waktu_transaksi'])); ?></td>
                            <td><?php echo $row['nama_pelanggan']; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td><?php echo formatRupiah($row['total']); ?></td>
                            <td>
                                <a href="detail_transaksi.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-detail">Lihat Detail</a>
                                <a href="hapus_transaksi.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-hapus" onclick="return confirm('Yakin hapus transaksi #<?php echo $row['id']; ?>?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data transaksi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>