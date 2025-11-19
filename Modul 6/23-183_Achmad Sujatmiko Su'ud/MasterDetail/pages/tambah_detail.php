<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Detail Transaksi</title>
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
    <h1>Tambah Detail Transaksi</h1>
    <form method="post">
      <label>Transaksi</label><br>
      <select name="transaksi_id" required>
        <option value="">-- Pilih Transaksi --</option>
        <?php
        $t = mysqli_query($conn, "SELECT * FROM transaksi");
        while ($tr = mysqli_fetch_assoc($t)) {
          echo "<option value='{$tr['id']}'>Transaksi ID {$tr['id']}</option>";
        }
        ?>
      </select><br><br>

      <label>Barang</label><br>
      <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>
        <?php
        $b = mysqli_query($conn, "SELECT * FROM barang");
        while ($br = mysqli_fetch_assoc($b)) {
          echo "<option value='{$br['id']}'>{$br['nama_barang']} - Rp {$br['harga']} (Stok: {$br['stok']})</option>"; // Tambah info stok
        }
        ?>
      </select><br><br>

      <label>Jumlah (Qty)</label><br>
      <input type="number" name="qty" required min="1"><br><br>

      <button type="submit" name="simpan" class="btn">Simpan</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
      $tid = $_POST['transaksi_id'];
      $bid = $_POST['barang_id'];
      $qty = $_POST['qty'];

      $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id='$tid' AND barang_id='$bid'");
      if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang sudah ditambahkan dalam transaksi ini!');</script>";
      } else {
        // 1. Ambil data barang (harga dan stok saat ini)
        $barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga, stok FROM barang WHERE id='$bid'"));
        $harga_satuan = $barang['harga'];
        $stok_saat_ini = $barang['stok'];
        $harga_total_item = $harga_satuan * $qty;

        // 2. Cek apakah stok mencukupi
        if ($qty > $stok_saat_ini) {
          echo "<script>alert('Stok barang tidak mencukupi! Stok saat ini: " . $stok_saat_ini . "');</script>";
        } else {
          // Stok mencukupi, lanjutkan proses
          
          // 3. Masukkan detail transaksi
          $insert_detail = mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) 
                                               VALUES ('$tid', '$bid', '$qty', '$harga_total_item')");

          if ($insert_detail) {
            // 4. Update/Kurangi Stok Barang
            mysqli_query($conn, "UPDATE barang SET stok = stok - $qty WHERE id='$bid'");

            // 5. Update Total Transaksi
            mysqli_query($conn, "UPDATE transaksi SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$tid') WHERE id='$tid'");

            echo "<script>alert('Detail berhasil ditambahkan dan stok telah dikurangi!');window.location='transaksi_detail.php';</script>";
          } else {
            echo "<script>alert('Gagal menambahkan detail transaksi.');</script>";
          }
        }
      }
    }
    ?>
  </div>
</body>

</html>