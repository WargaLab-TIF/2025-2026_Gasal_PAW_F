<?php
$koneksi = mysqli_connect("localhost","root","","penjualan");

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $sql_hapus="DELETE FROM barang WHERE id=$id";
    $sql_cek="SELECT 1 FROM transaksi_detail WHERE barang_id=$id LIMIT 1";
    $cek=mysqli_query($koneksi,$sql_cek);
    if (mysqli_num_rows($cek)){
        echo "<script>
            alert('Barang tidak dapat Dihapus Karena Digunakan dalam Transaksi Detail');
            window.location='index.php';
        </script>";
        exit;
    }
    else{mysqli_query($koneksi, $sql_hapus);}
    header("Location: index.php"); 
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        label{display:block;margin:8px 0}
        h2{font-family:arial; color:blue;}
		th{background-color:#27D3F5;}
		.adding{background-color:green; color:white; padding:11px 30px; border-radius: 4px; }
		.edit{background-color:#E0903F; color:white; padding:10px; border-radius: 4px;}
		.del{background-color:red; color:white; border-radius: 4px; padding:10px;}
        .layout{max-width: 585px;margin: 0 auto;padding: 1rem;background-color: #fff;border-radius: 8px;box-shadow: 0 0 20px rgba(0,0,0,0.1);}
    </style>
    
</head>
<body>

<main class="layout">
    <h2>Barang</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Kode Barang</th><th>Harga</th><th>Stok</th><th>Nama Supplier</th><th>Action</th>
        </tr>
        <?php
            $res = mysqli_query($koneksi, "SELECT * FROM barang");
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <?php 
            $sup=$row['supplier_id'];
            $temp=mysqli_query($koneksi,"SELECT nama FROM supplier WHERE id=$sup");
            $nameSup=mysqli_fetch_array($temp)
            ?>
            <td><?=$row['id']?></td>
            <td><?=$row['nama_barang']?></td>
            <td><?=$row['harga']?></td>
            <td><?=$row['stok']?></td>
            <td><?=$nameSup['nama']?></td>
            <td>
                <div style="display:flex; align-items:center; margin-bottom:10px; justify-content: space-between;">
                    <button class="del" onclick="if(confirm('Yakin hapus data <?=$row['nama_barang']?>?')) location.href='?delete=<?=$row['id']?>'">Hapus</button>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Transaksi</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Waktu Transaksi</th><th>Keterangan</th><th>Total</th><th>Nama Pelanggan</th>
        </tr>
        <?php
            $res = mysqli_query($koneksi, "SELECT * FROM transaksi");
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <?php 
            $pel=$row['pelanggan_id'];
            $tempel=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE id='$pel'");
            $namePel=mysqli_fetch_array($tempel)
            ?>
            <td><?=$row['id']?></td>
            <td><?=$row['waktu_transaksi']?></td>
            <td><?=$row['keterangan']?></td>
            <td><?=$row['total']?></td>
            <td><?=$namePel['nama']?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Transaksi Detail</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Transaksi ID</th><th>Nama Barang</th><th>Harga</th><th>QTY</th>
        </tr>
        <?php
            $res = mysqli_query($koneksi, "SELECT * FROM transaksi_detail");
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <?php 
            $barTransD=$row['barang_id'];
            $sqlbarTransD=mysqli_query($koneksi,"SELECT nama_barang FROM barang WHERE id=$barTransD");
            $nambar=mysqli_fetch_array($sqlbarTransD)
            ?>
            <td><?=$row['transaksi_id']?></td>
            <td><?=$nambar['nama_barang']?></td>
            <td><?=$row['harga']?></td>
            <td><?=$row['qty']?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <div style="display:flex; align-items:center; margin-bottom:10px">
        <form action="transaksi.php"><button class="adding">Tambah Transaksi</button></form>
        <form action="transaksiD.php"><button class="adding">Tambah Transaksi Detail</button></form>
    </div>
</main>
</body>
</html>