<?php
include './layout/header.php';
?>

    <div class="container mt-5">
    <h2 class="text-center">Data Master Transaksi</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="tambah_transaksi.php" class="btn btn-primary">Tambah Transaksi</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($transaksi = mysqli_fetch_assoc($data_transaksi)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $transaksi['id_transaksi'] ?></td>
                    <td><?= $transaksi['waktu_transaksi'] ?></td>
                    <td><?= $transaksi['nama_pelanggan'] ?></td>
                    <td><?= $transaksi['keterangan'] ?></td>
                    <td>Rp<?= number_format($transaksi['total'], 0, ',', '.') ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2 class="text-center">Data Master Transaksi Detail</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="tambah_transaksi_detail.php" class="btn btn-primary">Tambah Transaksi</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($transaksi_detail = mysqli_fetch_assoc($data_transaksi_detail)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $transaksi_detail['id_transaksi'] ?></td>
                    <td><?= $transaksi_detail['nama_barang'] ?></td>
                    <td><?= $transaksi_detail['harga'] ?></td>
                    <td><?= $transaksi_detail['qty'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
