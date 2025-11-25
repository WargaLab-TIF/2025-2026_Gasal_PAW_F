<?php
include './layout/header.php';
?>

    <div class="container mt-5">
    <h2 class="text-center">Data Supplier</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="tambah_supplier.php" class="btn btn-primary">Tambah Supplier</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($supplier = mysqli_fetch_assoc($data_supplier)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $supplier['nama'] ?></td>
                    <td><?= $supplier['telp'] ?></td>
                    <td><?= $supplier['alamat'] ?></td>
                    <td>
                        <a href="edit_supplier.php?id=<?= $supplier['id_supplier'] ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="hapus_supplier.php?id=<?= $supplier['id_supplier'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
