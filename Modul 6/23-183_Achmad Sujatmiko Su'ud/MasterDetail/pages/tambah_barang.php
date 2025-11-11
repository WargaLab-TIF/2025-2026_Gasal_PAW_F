<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
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
    <h1>Tambah Barang</h1>
    <form method="post">
      <?php
      // Ambil ID terakhir dari tabel barang
      $last = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(id) AS id_terakhir FROM barang"));
      $nextId = $last['id_terakhir'] + 1;
      $kodeBarang = 'BRG' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
      ?>

      <label>Kode Barang</label><br>
      <input type="text" name="kode_barang" value="<?= $kodeBarang ?>" readonly><br><br>

      <label>Nama Barang</label><br>
      <input type="text" name="nama" required><br><br>

      <label>Harga</label><br>
      <input type="number" name="harga" required><br><br>

      <label>Stok</label><br>
      <input type="number" name="stok" required><br><br>

      <label>Supplier</label><br>
      <input type="text" name="supplier" required><br><br>

      <button type="submit" name="simpan" class="btn">Simpan</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
      $kode = $_POST['kode_barang'];
      $nama = $_POST['nama'];
      $harga = $_POST['harga'];
      $stok = $_POST['stok'];
      $supplier = $_POST['supplier'];

      mysqli_query($conn, "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier)
                           VALUES ('$kode', '$nama', '$harga', '$stok', '$supplier')");
      echo "<script>alert('Barang berhasil ditambahkan!');window.location='barang.php';</script>";
    }
    ?>
  </div>
</body>

</html>