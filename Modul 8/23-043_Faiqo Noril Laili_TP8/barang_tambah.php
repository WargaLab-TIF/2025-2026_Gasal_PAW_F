<?php include 'koneksi.php'; ?>
<link rel="stylesheet" href="style.css">

<h2>Tambah Barang</h2>

<form method="POST" action="">
    <table>
        <tr>
            <td>Nama Barang</td>
            <td><input type="text" name="nama_barang" required></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td><input type="number" name="harga" min="0" required></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td><input type="number" name="stok" min="0" required></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" name="simpan">Simpan</button>
                <a href="barang.php">Kembali</a>
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['simpan'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Simpan ke database
    $query = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga, stok)
                                     VALUES ('$nama_barang', '$harga', '$stok')");

    if ($query) {
        echo "<script>
                alert('Barang berhasil ditambahkan!');
                window.location='barang.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menambahkan barang!');</script>";
    }
}
?>
