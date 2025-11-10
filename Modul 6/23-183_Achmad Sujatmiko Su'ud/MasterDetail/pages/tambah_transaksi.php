<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="main-content">
  <h1>Tambah Transaksi</h1>
  <form method="post">
    <label>Tanggal Transaksi</label><br>
    <input type="date" name="tanggal" required><br><br>

    <label>Keterangan</label><br>
    <textarea name="keterangan" minlength="3" required></textarea><br><br>

    <label>Pelanggan</label><br>
    <select name="pelanggan_id" required>
      <option value="">-- Pilih Pelanggan --</option>
      <?php
      $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
      while ($p = mysqli_fetch_assoc($pelanggan)) {
          echo "<option value='{$p['id']}'>{$p['nama']}</option>";
      }
      ?>
    </select><br><br>

    <button type="submit" name="simpan" class="btn">Simpan</button>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
      $tanggal = $_POST['tanggal'];
      $ket = $_POST['keterangan'];
      $pid = $_POST['pelanggan_id'];

      if ($tanggal < date('Y-m-d')) {
          echo "<script>alert('Tanggal tidak boleh kurang dari hari ini!');</script>";
      } else {
          mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$tanggal', '$ket', 0, '$pid')");
          echo "<script>alert('Transaksi berhasil ditambahkan!');window.location='transaksi.php';</script>";
      }
  }
  ?>
</div>
</body>
</html>
