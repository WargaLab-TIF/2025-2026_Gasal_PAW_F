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

if ($wewenang > 1){
    $_SESSION['pesan']="Anda Bukan owner";
    header("Location: ../login.php");
    exit;
};

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $sql_hapus="DELETE FROM pelanggan WHERE id=$id";
    mysqli_query($koneksi, $sql_hapus);
    mysqli_query($koneksi,"ALTER TABLE pelanggan AUTO_INCREMENT = 1;");
    header("Location: pelanggan.php"); 
    exit;
}

$sql = "SELECT * FROM pelanggan";
$res = mysqli_query($koneksi, $sql);
?>

<!doctype html>
<html>
<head>
    <title>Crud Pelanggan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="layout">
    <?php if(isset($_SESSION['username'])):?>
    <h2>SISTEM PENJUALAN</h2>
    <div style="display:flex; align-items:center; margin-bottom:10px;">
        <h3>Selamat Datang: <?=$lev['nama']?></h3>
    </div>
    <nav class="menu">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <?php if ($wewenang == 1): ?>
                <li><a href="barang.php">Barang</a></li>
                <li><a href="supplier.php">Supplier</a></li>
                <li><a href="pelanggan.php">Pelanggan</a></li>
                <li><a href="user.php">User</a></li>
                <?php endif; ?>
                <li><a href="../laporan/report_transaksi.php">Laporan</a></li>
                <li><a href="../Transaksi/transaksi.php">Transaksi</a></li>
                <li><a href="../include/logOut.php">LogOut</a></li>
            </ul>
    </nav>
    <br>
    <div style="display:flex; align-items:center; margin-bottom:10px;">
        <form action="./add/addpeng.php" ><button class="adding">Tambah Pelanggan</button></form>
    </div>
    <table border="1" cellpadding="8">
        <tr>
            <th>No</th><th>ID</th><th>Nama</th><th>JK</th><th>telp</th><th>alamat</th><th>Tindakan</th>
        </tr>
        <?php
            $no=1;
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <td><?=$no++;?></td>
            <td><?=$row['id']?></td>
            <td><?=$row['nama']?></td>
            <td><?=$row['jenis_kelamin']?></td>
            <td><?=$row['telp']?></td>
            <td><?=$row['alamat']?></td>
            <td>
                <div style="display:flex; align-items:center; margin-bottom:10px; justify-content: space-between;">
                    <button class="detail" onclick="location.href='./edit/edpeng.php?id=<?=$row['id']?>'">Edit</button>
                    <button class="del" onclick="if(confirm('Yakin ingin hapus Pelanggan <?=$row['nama']?>')) location.href='?delete=<?=$row['id']?>'">Hapus</button>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php endif;?>
</main>
</body>
</html>