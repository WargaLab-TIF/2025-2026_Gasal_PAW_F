<?php
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .mx-auto{width:800px}
        .card{margin-top:15px}
        table { width: 100%; border-collapse: collapse; } 
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
        .edit { background-color: yellow;}
        .hapus { background-color: red;}   
        </style>
</head>
<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Master Supplier
            </div>
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-end">
                    <a href="tambah.php" class="btn btn-primary" role="button">Tambah Data</a>
                </div>
                <table border="1">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php $no = 1; ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++ ?></td> 
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['telp']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id']?>" class="btn edit">Edit</a>
                            <a href="delete.php?id=<?= $row['id']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data supplier <?= htmlspecialchars($row['nama']) ?>?');" class="btn hapus">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
                <?php if (mysqli_num_rows($result) == 0): ?>
                    <div class="alert alert-info mt-3" role="alert">
                        Belum ada data supplier.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>