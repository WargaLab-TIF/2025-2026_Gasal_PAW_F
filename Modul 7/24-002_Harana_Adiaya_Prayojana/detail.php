<?php
    require_once('./include/conn.php');
    $data=[];
    $id = (int)$_GET['id'];
    echo $id;
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
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <div style="display:flex; align-items:center; margin-bottom:10px;">
            <form action="index.php" ><button class="adding">Kembali</button></form>
        </div>
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