<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="sidebar">
  <h2>Master Detail</h2>
  <a href="barang.php">Barang</a>
  <a href="transaksi.php" class="active">Transaksi</a>
  <a href="transaksi_detail.php">Transaksi Detail</a>
  <div class="logout">
    <a href="#" style="color:white;text-decoration:none;">Logout</a>
  </div>
</div>

<div class="main-content">
  <h1>Tambah Transaksi</h1>

  <form method="post">
    <label for="tanggal">Tanggal Transaksi</label><br>
    <input type="date" id="tanggal" name="tanggal" required><br><br>

    <label for="keterangan">Keterangan</label><br>
    <textarea id="keterangan" name="keterangan" minlength="3" required placeholder="Masukkan keterangan transaksi"></textarea><br><br>
    <label for="total">Total</label><br>
    <input type="number" id="total" name="total" placeholder="Isi jika ingin langsung menentukan total"><br><br>

    <label for="pelanggan_id">Pelanggan</label><br>
    <select id="pelanggan_id" name="pelanggan_id" required>
      <option value="">-- Pilih Pelanggan --</option>
      <?php
      // Ambil daftar pelanggan dari tabel pelanggan
      $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama ASC");
      while ($p = mysqli_fetch_assoc($pelanggan)) {
          echo "<option value='{$p['id']}'>{$p['nama']}</option>";
      }
      ?>
    </select><br><br>


    <button type="submit" name="simpan" class="btn">Simpan Transaksi</button>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
      $tanggal = $_POST['tanggal'];
      $keterangan = $_POST['keterangan'];
      $pelanggan_id = $_POST['pelanggan_id'];
      $total = !empty($_POST['total']) ? $_POST['total'] : 0;

      // Validasi tanggal tidak boleh sebelum hari ini
      $hari_ini = date('Y-m-d');
      if ($tanggal < $hari_ini) {
          echo "<script>alert('Tanggal transaksi tidak boleh kurang dari hari ini!');</script>";
      } elseif (strlen($keterangan) < 3) {
          echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
      } else {
          $insert = mysqli_query($conn, "
              INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
              VALUES ('$tanggal', '$keterangan', '$total', '$pelanggan_id')
          ");

          if ($insert) {
              echo "<script>alert('Transaksi berhasil ditambahkan!');window.location='transaksi.php';</script>";
          } else {
              echo "<script>alert('Gagal menyimpan transaksi!');</script>";
          }
      }
  }
  ?>
</div>

</body>
</html>
