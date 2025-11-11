<?php
include 'koneksi.php';

// $conn = new mysqli("localhost", "root", "", "store");

$sqlBarang = "SELECT * FROM barang ORDER BY id ASC";
$resultBarang = mysqli_query($conn, $sqlBarang);

$sqlTransaksi = "SELECT * FROM transaksi ORDER BY id ASC";
$resultTransaksi = mysqli_query($conn, $sqlTransaksi);

$sqlDetail = "SELECT * FROM transaksi_detail ORDER BY transaksi_id ASC";
$resultDetail = mysqli_query($conn,$sqlDetail);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Pengelolaan Master Detail</title>
</head>
<body>

<h2>Pengelolaan Master Detail</h2>

<h3>Barang</h3>
<table border="1" cellpadding="4" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supplier</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($resultBarang) > 0): ?>
               <?php while ($row = mysqli_fetch_assoc($resultBarang)): ?>
                <tr>
                  <?php
                  $supplier_id = $row['supplier_id'];
                  $qSupplier = mysqli_query($conn, "SELECT nama FROM supplier WHERE id='$supplier_id'");
                  $supplier = mysqli_fetch_assoc($qSupplier);
                  $nama_supplier = $supplier ? $supplier['nama'] : '-';
                  ?>
                  <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['kode_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= $nama_supplier ?></td>
                    <td><button onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')) window.location='delete_barang.php?id=<?= $row['id'] ?>';">Delete</button></td>
                  </tr>
                <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7" align="center">Tidak ada data barang</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="display: flex; gap: 30px; margin-top: 40px;">
  <div style="flex: 1;">
    <h3>Transaksi</h3>
    <table border="1" cellpadding="4" cellspacing="0" style="width: 100%;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Waktu Transaksi</th>
          <th>Keterangan</th>
          <th>Total</th>
          <th>Nama Pelanggan</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($resultTransaksi) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($resultTransaksi)): ?>
          <?php
          $pelanggan_id = $row['pelanggan_id'];
          $qPelanggan = mysqli_query($conn, "SELECT nama FROM pelanggan WHERE id='$pelanggan_id'");
          $pelanggan = mysqli_fetch_assoc($qPelanggan);
          $nama_pelanggan = $pelanggan ? $pelanggan['nama'] : '-';
          ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['waktu_transaksi'] ?></td>
          <td><?= $row['keterangan'] ?: '-' ?></td>
          <td><?= number_format($row['total'], 0, ',', '.') ?></td>
          <td><?= $nama_pelanggan ?></td>
        </tr>

          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5" align="center">Tidak ada data transaksi</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div style="flex: 1;">
    <h3>Transaksi Detail</h3>
    <table border="1" cellpadding="4" cellspacing="0" style="width: 100%;">
      <thead>
        <tr>
          <th>Transaksi ID</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Qty</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($resultDetail) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($resultDetail)): ?>
          <?php
          $barang_id = $row['barang_id'];
          $qBarang = mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id='$barang_id'");
          $barang = mysqli_fetch_assoc($qBarang);
          $nama_barang = $barang ? $barang['nama_barang'] : '-';
          ?>
          <tr>
            <td><?= $row['transaksi_id'] ?></td>
            <td><?= $nama_barang ?></td>
            <td><?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?= $row['qty'] ?></td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" align="center">Tidak ada data detail transaksi</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div style="margin-top: 30px;">
  <button onclick="window.location.href='tambah_transaksi.php';" style="padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer;">Tambah Transaksi</button>
  <button onclick="window.location.href='tambah_transaksidetail.php';" style="padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 6px; margin-left: 10px; cursor: pointer;">Tambah Transaksi Detail</button>
</div>

</body>
</html>
