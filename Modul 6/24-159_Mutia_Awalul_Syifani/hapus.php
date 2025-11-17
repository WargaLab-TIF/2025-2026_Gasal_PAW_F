<?php
include 'koneksi.php';

$errorMsg = "";
$successMsg = "";

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $cek = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = '$delete_id'");
    $dataCek = mysqli_fetch_array($cek);

    if ($dataCek['jumlah'] > 0) {
        $errorMsg = "Barang tidak dapat dihapus karena digunakan dalam transaksi detail!";
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM barang WHERE id = '$delete_id'");
        if ($hapus) {
            $successMsg = "Barang berhasil dihapus.";
        } else {
            $errorMsg = "Gagal menghapus barang: " . mysqli_error($conn);
        }
    }
}

$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id ASC");

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Barang</title>
<script>
function confirmDelete(id) {
  if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
    window.location.href = "barang.php?delete_id=" + id;
  }
}
</script>
</head>
<body>

<h2>Daftar Barang</h2>

<?php if ($errorMsg != ""): ?>
  <div class="message error"><?= $errorMsg ?></div>
<?php elseif ($successMsg != ""): ?>
  <div class="message success"><?= $successMsg ?></div>
<?php endif; ?>

<table border="1" cellspacing="0" cellpadding="4">
  <thead>
    <tr>
      <th>ID</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Supplier</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_array($result)): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['kode_barang'] ?></td>
          <td><?= $row['nama_barang'] ?></td>
          <td><?= number_format($row['harga'], 0, ',', '.') ?></td>
          <td><?= $row['stok'] ?></td>
          <td><?= $row['supplier_id'] ?></td>
          <td><button class="btn-delete" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</button></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7" align="center">Tidak ada data barang</td></tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
