<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengelolaan Master Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="tambah_data_transaksi.php" class="button">Tambah Transaksi</a>
        <a href="tambah_detail_transaksi.php" class="button">Tambah Transaksi Detail</a>
    </div>
    <div class="container">
        <h2>Barang</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nama Supplier</th>
                <th>Action</th>
            </tr>

<?php
            $data_Barang = "SELECT barang.*, supplier.nama_supplier FROM barang 
            JOIN supplier ON barang.supplier_id = supplier.id";
            $query_Barang = mysqli_query($koneksi, $data_Barang);
            if (!$query_Barang) {
                echo "Error query Barang: " . mysqli_error($koneksi);
            }
            while ($DATA = mysqli_fetch_assoc($query_Barang)) {
                echo "<tr>";
                echo "<td>" . $DATA['id'] . "</td>";
                echo "<td>" . $DATA['kode_barang'] . "</td>";
                echo "<td>" . $DATA['nama_barang'] . "</td>";
                echo "<td>" . $DATA['harga'] . "</td>";
                echo "<td>" . $DATA['stok'] . "</td>";
                echo "<td>" . $DATA['nama_supplier'] . "</td>"; 
                echo "<td>
                        <a href='hapus.php?ID=".$DATA['id']."'class='delete' onclick='return konfirmasi_hapus();'>Delete</a>
                      </td>";
                echo "</tr>";
            }
?>
        </table>
    </div>
    <div class="container">
        <h2>Transaksi</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th>
            </tr>
            <?php
            $data_Transaksi = "SELECT Transaksi.*, Pelanggan.nama AS Nama_Pelanggan FROM transaksi 
            JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id ORDER BY transaksi.id "; 
            $query_Transaksi = mysqli_query($koneksi, $data_Transaksi);
            if (!$query_Transaksi) {
                echo "Error query Transaksi: " . mysqli_error($koneksi);
            }
            while ($DATA = mysqli_fetch_assoc($query_Transaksi)) {
                echo "<tr>";
                echo "<td>" . $DATA['id'] . "</td>";
                echo "<td>" . $DATA['date_transaksi'] . "</td>"; 
                echo "<td>" . $DATA['keterangan'] . "</td>";
                echo "<td>" . $DATA['total'] . "</td>";
                echo "<td>" . $DATA['Nama_Pelanggan'] . "</td>"; 
                echo "</tr>";
            }
            ?>

        </table>
    </div>
    <div class="container">
        <h2>Transaksi Detail</h2>
        <table border="1">
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga Total</th>
                <th>Qty</th>
            </tr>
            <?php
            $data_detail = "SELECT Transaksi_Detail.*, Barang.nama_barang FROM transaksi_detail 
            JOIN barang ON transaksi_detail.ID_barang = barang.id ORDER BY transaksi_detail.ID_Transaksi ";
            $query_detail = mysqli_query($koneksi, $data_detail);
            if (!$query_detail) {
                die("Error query detail: " . mysqli_error($koneksi));
            }
            while ($DATA = mysqli_fetch_assoc($query_detail)) {
                echo "<tr>";
                echo "<td>" . $DATA['ID_Transaksi'] . "</td>"; 
                echo "<td>" . $DATA['nama_barang'] . "</td>"; 
                echo "<td>" . $DATA['harga'] . "</td>";
                echo "<td>" . $DATA['qty'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <script>
    function konfirmasi_hapus() {
        var konfirmasi = confirm("Apakah anda yakin ingin menghapus data ini?");
        if (konfirmasi) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>
</html>