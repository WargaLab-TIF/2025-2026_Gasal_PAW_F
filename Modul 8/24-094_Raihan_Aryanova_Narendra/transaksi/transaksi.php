<?php
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        /* ====== RESET DAN GLOBAL ====== */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f4f4f9;
    color: #333;
}

/* ====== CONTAINER ====== */
.container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
}

/* ====== CARD ====== */
.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,60,0.06);
    overflow: hidden;
}

.card-header {
    background: #ffffffff;
    padding: 18px 25px;
    color: #000000ff;
}

.card-header h4 {
    margin: 0;
}

/* ====== BUTTONS ====== */
.btn {
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    display: inline-block;
    margin-bottom: 8px;
    transition: 0.2s ease;
    color: #fff;
}

.btn-success {
    background: #1e9e52;
}
.btn-success:hover {
    background: #167d41;
}

.btn-secondary {
    background: #6c757d;
}
.btn-secondary:hover {
    background: #5c6268;
}

.btn-info {
    background: #2980b9;
}
.btn-info:hover {
    background: #1f6692;
}

.btn-danger {
    background: #e63946;
}
.btn-danger:hover {
    background: #c62828;
}

/* ====== TABLE ====== */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
}

.table thead tr {
    background: #2a2a72;
    color: #fff;
}

.table th,
.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e5e5e5;
}

.table tbody tr:nth-child(even) {
    background: #faf9ff;
}

.table tbody tr:hover {
    background: #f1ecff;
}

/* ====== SMALL BUTTONS (DALAM TABEL) ====== */
.btn-sm {
    padding: 6px 10px;
    font-size: 12px;
}

/* ====== RESPONSIVE ====== */
@media(max-width: 768px) {
    .table th, .table td {
        padding: 8px;
        font-size: 12px;
    }

    .btn {
        padding: 7px 10px;
        font-size: 12px;
    }

    .container {
        padding: 0 10px;
    }
}

    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Laporan Data Transaksi</h4>
        </div>
        <div class="card-body">
            <a href="transaksi/tambah_transaksi.php" class="btn btn-success mb-3">+ Tambah Transaksi Baru</a>
            <a href="home.php" class="btn btn-secondary mb-3">Kembali ke Home</a>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total Belanja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Join tabel transaksi dengan pelanggan
                    $query = mysqli_query($koneksi, "SELECT t.*, p.nama_pelanggan 
                                                     FROM transaksi t 
                                                     JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                                                     ORDER BY t.waktu_transaksi DESC");
                    
                    $no = 1;
                    while($d = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($d['waktu_transaksi'])); ?></td>
                        <td><?= $d['nama_pelanggan']; ?></td>
                        <td><?= $d['keterangan']; ?></td>
                        <td>Rp <?= number_format($d['total'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="transaksi/detail.php?id=<?= $d['id_transaksi']; ?>" class="btn btn-info btn-sm">Detail</a>
                            
                            <a href="hapus_transaksi.php?id=<?= $d['id_transaksi']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus transaksi ini beserta detailnya?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>