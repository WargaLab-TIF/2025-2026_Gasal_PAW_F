<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
$nama_user = $_SESSION['nama'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .nav {
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
            border-collapse: collapse;
            background: #007bff;
            padding: 10px;
            border-radius: 8px;
            color: white;
        }
        .nav td { padding: 10px 20px; }
        .nav a { color: white; text-decoration: none; font-weight: bold; }
        .nav a:hover { text-decoration: underline; }
        select { padding: 5px 8px; border-radius: 5px; border: none; }
    </style>
</head>
<body>
    <table class="nav">
        <tr>
            <td><h2>Hai <?= htmlspecialchars($nama_user) ?></h2></td>
            <td><a href="admin.php">Home</a></td>
            <td>
                <select onchange="if(this.value) location.href=this.value;">
                    <option value="">Data Master</option>
                    <option value="barang.php">Data Barang</option>
                    <option value="supplier.php">Data Supplier</option>
                    <option value="pelanggan.php">Data Pelanggan</option>
                    <option value="userT.php">Data User</option>
                </select>
            </td>
            <td><a href="transaksi.php">Transaksi</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            <td><a href="logout.php">Logout</a></td>
        </tr>
    </table>
</body>
</html>
