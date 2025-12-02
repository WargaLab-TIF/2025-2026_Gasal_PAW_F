<?php
require_once('./include/conn.php');

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $sql_hapus="DELETE FROM transaksi WHERE id=$id";
    mysqli_query($koneksi, $sql_hapus);
    header("Location: index.php"); 
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<main class="layout">
    <h2>Data Master Transaksi</h2>
    <div style="display:flex; align-items:center; margin-bottom:10px;">
        <form action="./laporan/report_transaksi.php" style="margin-left:auto; margin-right:20px;"><button class="report">Lihat Laporan Penjualan</button></form>
        <form action="form_add.php" ><button class="adding">Tambah Transaksi</button></form>
    </div>
    <table border="1" cellpadding="8">
        <tr>
            <th>No</th><th>ID Transaksi</th><th>Waktu Transaksi</th><th>Nama Pelanggan</th><th>Keterangan</th><th>Total</th><th>Tindakan</th>
        </tr>
        <?php
            $res = mysqli_query($koneksi, "SELECT * FROM transaksi");
            $no=1;
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <?php 
                $nam=$row['pelanggan_id'];
                $TemNam=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE id='$nam'"); 
                $namPel=mysqli_fetch_array($TemNam);
            ?>
            <td><?=$no++;?></td>
            <td><?=$row['id']?></td>
            <td><?=$row['waktu_transaksi']?></td>
            <td><?=$namPel['nama']?></td>
            <td><?=$row['keterangan']?></td>
            <td><?=$row['total']?></td>
            <td>
                <div style="display:flex; align-items:center; margin-bottom:10px; justify-content: space-between;">
                    <button class="detail" onclick="location.href='detail.php?id=<?=$row['id']?>'">Lihat Detail</button>
                    <button class="del" onclick="if(confirm('Yakin hapus Transaksi <?=$row['keterangan']?>?')) location.href='?delete=<?=$row['id']?>'">Hapus</button>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</main>
</body>
</html>