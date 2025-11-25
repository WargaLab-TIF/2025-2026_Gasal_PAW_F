<?php
include './layout/header.php';
?>

    <div class="container mt-5">
    <h2 class="text-center">Data User</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="tambah_user.php" class="btn btn-primary">Tambah User</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telpon</th>
                <th>Level</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($user = mysqli_fetch_assoc($data_user)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['nama'] ?></td>
                    <td><?= $user['alamat'] ?></td>
                    <td><?= $user['hp'] ?></td>
                    <td><?= $user['level'] ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $user['id_user'] ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="hapus_user.php?id=<?= $user['id_user'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
