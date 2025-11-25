<?php
include './layout/header.php';
?>

    <div class="container mt-5">
    <h2 class="text-center">Data Barang</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="tambah_barang.php" class="btn btn-primary">Tambah Barang</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($barang = mysqli_fetch_assoc($data_barang)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $barang['kode_barang'] ?></td>
                    <td><?= $barang['nama_barang'] ?></td>
                    <td>Rp<?= number_format($barang['harga'], 0, ',', '.') ?></td>
                    <td><?= $barang['stok'] ?></td>
                    <td>
                        <a href="edit_barang.php?id=<?= $barang['id_barang'] ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="hapus_barang.php?id=<?= $barang['id_barang'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
