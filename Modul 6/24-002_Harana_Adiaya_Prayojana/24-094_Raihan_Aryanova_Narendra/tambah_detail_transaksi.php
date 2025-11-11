<?php
include 'koneksi.php';
$Data_Barang = "SELECT id, nama_barang FROM barang ORDER BY nama_barang";
$Query_barang = mysqli_query($koneksi, $Data_Barang);
if (!$Query_barang) { 
    echo "Error query Barang.";
}
$Data_Transaksi = "SELECT id, CONCAT(id, ' . ', keterangan) AS Informasi FROM transaksi ORDER BY id DESC";
$Query_transaksi = mysqli_query($koneksi, $Data_Transaksi);
if (!$Query_transaksi) { 
    echo "Error query Transaksi.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Detail Transaksi</h2>
        <form action="proses_detail_transaksi.php" method="POST">
            <label for="ID_Transaksi">ID Transaksi:</label>
            <select ID="ID_Transaksi" name="ID_Transaksi" required>
                <option value="">Pilih ID Transaksi</option>
<?php
                while ($data = mysqli_fetch_assoc($Query_transaksi)) {
                    echo "<option value='" . $data['id'] . "'>" . $data['Informasi'] . "</option>";
                }
?>
            </select>
            
            <label for="Pilih_Barang">Pilih Barang:</label>
            <select ID="Pilih_Barang" name="Pilih_Barang" required>
                <option value="">Pilih Barang</option>
<?php
                while ($data = mysqli_fetch_assoc($Query_barang)) {
                    echo "<option value='" . $data['id'] . "'>" . $data['nama_barang'] . "</option>";
                }
?>
            </select>
            
            <label for="qty">Quantity:</label>
            <input type="number" ID="qty" name="qty" min="1" required 
                   placeholder="Masukkan jumlah Barang">
            <button type="submit">Tambah Detail Transaksi</button>
        </form>
         <br>
        <a href="index.php" class="button">Kembali</a>
    </div>
</body>
</html>