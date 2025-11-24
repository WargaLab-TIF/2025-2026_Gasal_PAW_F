<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
}
$nama = $_SESSION['nama'];

$stmt = mysqli_prepare($conn, "SELECT id_user, username, nama, level FROM user ORDER BY id_user ASC");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Toko josjis</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/barang/barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/supplier/supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/pelanggan/pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item active" href="data_user.php">Data User</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/transaksi/transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/laporan/laporan.php">Laporan</a>
                    </li>
                </ul>
                <span class="navbar-text text-white me-3">
                    👤 <?= $nama; ?>
                </span>
                <a href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex justify-content-between">
                            <h4 class="mb-0">Daftar User</h4>
                            <a href="./tambah.php" class="btn btn-warning btn-sm">+ Tambah User</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($data = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['username']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td>
                                            <?php 
                                            if ($data['level'] == 1){
                                                echo "Owner";
                                            } elseif ($data['level'] == 2){
                                                echo "Kasir";
                                            } else {
                                                echo "Tidak diketahui";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="./edit.php?id_user=<?= $data['id_user']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="./hapus.php?id_user=<?= $data['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?');">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                        
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
