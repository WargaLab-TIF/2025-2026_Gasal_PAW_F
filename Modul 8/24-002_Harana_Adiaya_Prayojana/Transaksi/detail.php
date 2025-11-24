<?php
    session_start();
    require_once('../include/conn.php');

    if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
    }

    $user= $_SESSION['username'];
    $sql="SELECT * FROM user WHERE username='$user'";
    $tem=mysqli_query($koneksi, $sql);
    $lev=mysqli_fetch_array($tem);
    $wewenang=$lev['level'];

    $data=[];
    $id = (int)$_GET['id'];
    
    $sql = "SELECT td.transaksi_id,
               b.nama_barang,
               td.harga,
               td.qty,
               t.total
            FROM transaksi_detail td
            JOIN barang b ON b.id = td.barang_id
            JOIN transaksi t ON t.id=td.transaksi_id
            WHERE td.transaksi_id = $id";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($result);
    
    if(!$data) {
        die("Data tidak ditemukan!");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Detail Transaksi ID <?=$data['transaksi_id']?></title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <h2>SISTEM PENJUALAN</h2>
        <div style="display:flex; align-items:center; margin-bottom:10px;">
            <h3>Selamat Datang: <?=$lev['nama']?></h3>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="../index.php">Home</a></li>

                <?php if ($wewenang == 1): ?>
                <li><a href="../masters/barang.php">Barang</a></li>
                <li><a href="../masters/supplier.php">Supplier</a></li>
                <li><a href="../masters/pelanggan.php">Pelanggan</a></li>
                <li><a href="../masters/user.php">User</a></li>
                <?php endif; ?>
                <li><a href="../laporan/report_transaksi.php">Laporan</a></li>
                <li><a href="transaksi.php">Transaksi</a></li>
                <li><a href="../include/logOut.php">LogOut</a></li>
            </ul>
        </nav>
        <br>
        <a href="transaksi.php"><button type="button" class="adding">Kembali</button></a>
        <table border="1" cellpadding="8">
            <tr>
                <th>Transaksi ID</th><th>Nama Barang</th><th>Harga</th><th>QTY</th><th>total</th>
            </tr>
            <?php
                while($rows=mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><?=$rows['transaksi_id']?></td>
                <td><?=$rows['nama_barang']?></td>
                <td>Rp <?=$rows['harga']?></td>
                <td><?=$rows['qty']?></td>
                <td><?=$rows['total']?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </body>
</html>