<?php
include "../cek_login.php";
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah barang digunakan di transaksi_detail
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");
    $adaData = false;

    // Kalau ada baris hasil query, berarti barang sudah dipakai
    while ($data = mysqli_fetch_array($cek)) {
        $adaData = true;
    }

    if ($adaData == true) {
        echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail!');</script>";
    } 
    else {
        mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
        echo "<script>alert('Data barang berhasil dihapus!');</script>";
    }
}

// Ambil data barang dari tabel
$query = "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS supplier
          FROM barang b, supplier s
          WHERE b.supplier_id = s.id";
$barang = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Barang</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; padding: 20px;">

<div style="width: 90%; margin: auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
    <h2 style="text-align: center; margin-bottom: 20px;">Daftar Barang</h2>

    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: center;">
        <tr style="background-color: #e0e0e0;">
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supplier</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_array($barang)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['harga']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['supplier']; ?></td>
            <td>
                <a href="hapus_barang.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                   style="color: white; background-color: red; padding: 5px 10px; border-radius: 5px; text-decoration: none;">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
