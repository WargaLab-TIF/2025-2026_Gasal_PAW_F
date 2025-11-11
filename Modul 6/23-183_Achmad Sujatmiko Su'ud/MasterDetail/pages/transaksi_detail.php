<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Data Transaksi Detail</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

  <div class="sidebar">
    <h2>Master Detail</h2>
    <a href="barang.php">Barang</a>
    <a href="transaksi.php">Transaksi</a>
    <a href="transaksi_detail.php" class="active">Transaksi Detail</a>
  </div>

  <div class="main-content">
    <h1>Data Transaksi Detail</h1>

    <table>
      <tr>
        <th>ID Transaksi</th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Harga</th>
      </tr>
      <?php
      $data = mysqli_query($conn, "
      SELECT td.*, b.nama_barang 
      FROM transaksi_detail td
      JOIN barang b ON td.barang_id = b.id
    ");
      while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
          <td>{$row['transaksi_id']}</td>
          <td>{$row['nama_barang']}</td>
          <td>{$row['qty']}</td>
          <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
        </tr>";
      }
      ?>
    </table>

    <div class="button-container">
      <a href="tambah_detail.php" class="btn">Tambah Detail Transaksi</a>
    </div>
  </div>

</body>

</html>