<?php
include 'koneksi.php';

$query_transaksi = "
SELECT t.*, p.nama AS nama_pelanggan
FROM transaksi t
JOIN pelanggan p ON t.pelanggan_id = p.id
";
$result_transaksi = mysqli_query($conn, $query_transaksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Master Transaksi</title>

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
.navbar { background-color: #1f2937 !important; }
.navbar-brand span { color: #facc15 !important; }

.page-title {
    background-color: #007bff;
    color: white;
    padding: 10px;
    border-radius: 5px;
}
.header-button {
    background-color: #007bff !important;
    color: white !important;
}
</style>

</head>
<body>
    <nav class="navbar navbar-dark">
        <a class="navbar-brand text-white" href="#">
            Penjualan <span>XYZ</span>
        </a>
        <div>
            <a href="#" class="text-white mx-2">Supplier</a>
            <a href="#" class="text-white mx-2">Barang</a>
            <a href="#" class="text-white mx-2">Transaksi</a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h4 class="mb-3 page-title">Data Master Transaksi</h4>
        <div class="d-flex justify-content-end mb-3">
            <a href="report_transaksi.php" class="btn header-button mr-2">Lihat Laporan Penjualan</a>
            <a href="#" class="btn btn-success">Tambah Transaksi</a>
        </div>
        
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
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
                while ($row = mysqli_fetch_assoc($result_transaksi)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['waktu_transaksi'] . "</td>";
                    echo "<td>" . $row['nama_pelanggan'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>Rp" . number_format($row['total'], 0, ',', '.') . "</td>";
                    echo "<td>";
                    echo "<a href='#' class='btn btn-info btn-sm'>Detail</a> ";
                    echo "<a href='#' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin hapus transaksi ini?');\">Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>