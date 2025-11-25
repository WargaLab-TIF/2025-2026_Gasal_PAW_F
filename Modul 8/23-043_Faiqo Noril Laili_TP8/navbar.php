<?php
include 'koneksi.php';
session_start(); 


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$level = $_SESSION['level'];

$user_query = "SELECT username FROM logadmin WHERE username = '$username'";
$user_result = mysqli_query($koneksi, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$nama_user = $user_data['nama'] ?? $username;

$base_url = "/praktikum/24-044_Miftahul_Arifin/"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand text-white d-flex align-items-center" href="#">
                <i class="fas fa-book mr-2"></i>
                <span>Sistem Penjualan</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="<?= $base_url; ?>navbar.php">Home</a></li>
                <?php if ($level === "1") : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data Master</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= $base_url; ?>barang.php">Data Barang</a>
                            <a class="dropdown-item" href="<?= $base_url; ?>supplier.php">Data Supplier</a>
                            <a class="dropdown-item" href="<?= $base_url; ?>pelanggan.php">Data Pelanggan</a>
                            <a class="dropdown-item" href="<?= $base_url; ?>User/user.php">Data User</a>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link text-white" href="<?= $base_url; ?>transaksi.php">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= $base_url; ?>report_transaksi.php">Laporan</a></li>
            </ul>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Selamat Datang, <?= $nama_user; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= $base_url; ?>index.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').on('click', function (e) {
                if ($(this).next('.dropdown-menu').is(':visible')) {
                    $(this).next('.dropdown-menu').removeClass('show');
                } else {
                    $('.dropdown-menu').removeClass('show');
                    $(this).next('.dropdown-menu').addClass('show'); 
                }
                e.stopPropagation();
            });

            $(document).on('click', function () {
                $('.dropdown-menu').removeClass('show');
            });
        });
    </script>
</body>
</html>