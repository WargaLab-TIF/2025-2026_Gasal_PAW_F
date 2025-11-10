<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Transaksi</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="sidebar">
  <h2>Master Detail</h2>
  <a href="barang.php">Barang</a>
  <a href="transaksi.php" class="active">Transaksi</a>
  <a href="transaksi_detail.php">Transaksi Detail</a>
  <div class="logout"><a href="#" style="color:white;text-decoration:none;">Logout</a></div>
</div>

<div class="main-content">
  <h1>Data Transaksi</h1>

  <table>
    <tr>
      <th>ID</th>
      <th>Tanggal</th>
      <th>Keterangan</th>
      <th>Total</th>
      <th>Pelanggan</th>
    </tr>
    <?php
    $data = mysqli_query($conn, "
      SELECT t.*, p.nama AS pelanggan
      FROM transaksi t
      JOIN pelanggan p ON t.pelanggan_id = p.id
    ");
    while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
          <td>{$row['id']}</td>
          <td>{$row['waktu_transaksi']}</td>
          <td>{$row['keterangan']}</td>
          <td>Rp ".number_format($row['total'],0,',','.')."</td>
          <td>{$row['pelanggan']}</td>
        </tr>";
    }
    ?>
  </table>

  <div class="button-container">
    <a href="tambah_transaksi.php" class="btn">Tambah Transaksi</a>
  </div>
</div>

</body>
</html>
