<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($host, $user, $password, $dbname);

$sql = "SELECT
            transaksi.id,
            transaksi.waktu_transaksi,
            transaksi.keterangan,
            pelanggan.nama AS nama_pelanggan,
            COALESCE(SUM(transaksi_detail.harga), 0) AS total_dihitung
        FROM
            transaksi
        JOIN
            pelanggan ON transaksi.pelanggan_id = pelanggan.id
        LEFT JOIN
            transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
        GROUP BY
            transaksi.id";
$transaksi = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Transaksi</h2>
    <table border="1">
        <tr>
            <td>id</td>
            <td>waktu transaksi</td>
            <td>keterangan</td>
            <td>total</td>
            <td>nama pelanggan</td>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($transaksi)): ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["waktu_transaksi"] ?></td>
            <td><?= $row["keterangan"] ?></td>
            <td><?= $row["total_dihitung"] ?></td>

            <td><?= $row["nama_pelanggan"] ?></td>

            </tr>
    <?php endwhile; ?>
    </table>
    
    <a href="input_transaksi.php"><button>Tambah Transaksi</button></a>
    <a href="input_detai_transaksi.php"><button>Tambah Transaksi Detail</button></a>
    
    
    <br>
    <h2>Barang</h2>    
    
    <?php
    $barang = mysqli_query($conn,"SELECT * FROM barang"); 
    ?>
    
    <table border="1">
        <tr>
            <td>id</td>
            <td>kode barang</td>
            <td>nama barang</td>
            <td>harga</td>
            <td>stok</td>
            <td>supplier id</td>
            <td>aksi</td>
        </tr>
        <?php while($row = mysqli_fetch_assoc($barang)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['kode_barang'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= $row['supplier_id'] ?></td>
            <td>
                <button onclick="return confirm('Yakin ingin menghapus item ini?');">
                    <a href="delete.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;">Hapus
                    </a>
                </button>
            </td>
        </tr>
    <?php endwhile?>
    </table>
    
    <h2>Transaksi detail</h2>
    <?php
    $sql_detail = " SELECT transaksi_detail.*,barang.nama_barang 
                    FROM transaksi_detail
                    JOIN barang ON transaksi_detail.barang_id = barang.id";
        
        $transaksi_detil = mysqli_query($conn, $sql_detail);
        ?>
    
    <table border="1">
        <tr>
            <td>id transaksi</td>
            <td>nama barang</td>
            <td>Harga</td>
            <td>Qty</td>
            
        </tr>
        <?php while($row = mysqli_fetch_assoc($transaksi_detil)): ?>
        <tr>
            <td><?= $row['transaksi_id'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><?= $row['qty'] ?></td>
        </tr>
    <?php endwhile?>
    </table>
</body>
</html>
