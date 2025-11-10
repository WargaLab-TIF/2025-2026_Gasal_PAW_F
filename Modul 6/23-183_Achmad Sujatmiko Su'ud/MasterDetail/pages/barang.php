<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Barang</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="sidebar">
  <h2>Master Detail</h2>
  <a href="barang.php" class="active">Barang</a>
  <a href="transaksi.php">Transaksi</a>
  <a href="transaksi_detail.php">Transaksi Detail</a>
  <div class="logout"><a href="#" style="color:white;text-decoration:none;">Logout</a></div>
</div>

<div class="main-content">
  <h1>Data Barang</h1>

  <table>
    <tr>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Supplier</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    $data = mysqli_query($conn, "SELECT * FROM barang ORDER BY id ASC");
    while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
            <td>{$no}</td>
            <td>{$row['kode_barang']}</td>
            <td>{$row['nama_barang']}</td>
            <td>Rp ".number_format($row['harga'],0,',','.')."</td>
            <td>{$row['stok']}</td>
            <td>{$row['supplier']}</td>
            <td><a href='hapus_barang.php?id={$row['id']}' class='btn btn-delete'>Hapus</a></td>
        </tr>";
        $no++;
    }
    ?>
  </table>

  <div class='button-container'>
    <a href='tambah_barang.php' class='btn'>Tambah Barang</a>
  </div>
</div>

</body>
</html>
