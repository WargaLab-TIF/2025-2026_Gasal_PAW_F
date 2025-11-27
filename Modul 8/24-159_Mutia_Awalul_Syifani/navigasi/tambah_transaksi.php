<?php
include "../koneksi.php";

$sqlBarang = "SELECT id, nama_barang FROM barang ORDER BY nama_barang ASC";
$resultBarang = mysqli_query($conn, $sqlBarang);

$sqlTransaksi = "SELECT id FROM transaksi ORDER BY id DESC";
$resultTransaksi = mysqli_query($conn, $sqlTransaksi);

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barang_id = $_POST["barang_id"];
    $transaksi_id = $_POST["transaksi_id"];
    $qty = $_POST["qty"];

    if (empty($barang_id)) {
        $error = "Pilih barang terlebih dahulu.";
    } elseif (empty($transaksi_id)) {
        $error = "Pilih ID transaksi terlebih dahulu.";
    } elseif ($qty < 1) {
        $error = "Quantity harus lebih dari 0.";
    } else {

        $cek_sql = "SELECT * FROM transaksi_detail 
                    WHERE transaksi_id = '$transaksi_id' AND barang_id = '$barang_id'";
        $cek_query = mysqli_query($conn, $cek_sql);

        if (mysqli_num_rows($cek_query) > 0) {
            $error = "Barang sudah ada di detail transaksi ini.";
        } else {
         
            $harga_query = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$barang_id'");
            $harga_data = mysqli_fetch_array($harga_query);
            $harga_satuan = $harga_data['harga'];

            $harga_total = $harga_satuan * $qty;

            $insert_sql = "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
                           VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total')";
            $simpan = mysqli_query($conn, $insert_sql);

            if ($simpan) {
                $update_sql = "UPDATE transaksi 
                               SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = '$transaksi_id') 
                               WHERE id = '$transaksi_id'";
                mysqli_query($conn, $update_sql);

                $success = "Detail transaksi berhasil ditambahkan.";
            } else {
                $error = "Gagal menambahkan detail transaksi: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Tambah Detail Transaksi</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f8f9fa;
    margin: 40px;
  }
  .form-container {
    width: 300px;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin: auto;
  }
  .form-container h3 {
    text-align: center;
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 24px;
    color: #222;
  }
  label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    color: #333;
    margin-bottom: 6px;
  }
  select, input[type="number"] {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-bottom: 16px;
    font-size: 14px;
  }
  button {
    width: 100%;
    border-radius: 6px;
    background-color: #007BFF;
    color: white;
    padding: 10px;
    font-size: 15px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: 0.2s;
  }
  button:hover {
    background-color: #0056b3;
  }
  .message {
    text-align: center;
    font-weight: 600;
    margin-bottom: 15px;
  }
  .error { color: #c53030; }
  .success { color: #2f855a; }
</style>
</head>
<body>

<div class="form-container">
  <h3>Tambah Detail Transaksi</h3>

  <?php if ($error != ""): ?>
    <div class="message error"><?= $error ?></div>
  <?php elseif ($success != ""): ?>
    <div class="message success"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <label for="barang_id">Pilih Barang</label>
    <select id="barang_id" name="barang_id" required>
      <option value="">-- Pilih Barang --</option>
      <?php 
      if ($resultBarang && mysqli_num_rows($resultBarang) > 0) {
          while ($b = mysqli_fetch_array($resultBarang)) {
              echo "<option value='{$b['id']}'>{$b['nama_barang']}</option>";
          }
      } else {
          echo "<option value=''>Data barang tidak ditemukan</option>";
      }
      ?>
    </select>

    <label for="transaksi_id">Pilih ID Transaksi</label>
    <select id="transaksi_id" name="transaksi_id" required>
      <option value="">-- Pilih Transaksi --</option>
      <?php 
      if ($resultTransaksi && mysqli_num_rows($resultTransaksi) > 0) {
          while ($t = mysqli_fetch_array($resultTransaksi)) {
              echo "<option value='{$t['id']}'>Transaksi #{$t['id']}</option>";
          }
      } else {
          echo "<option value=''>Belum ada transaksi</option>";
      }
      ?>
    </select>

    <label for="qty">Quantity</label>
    <input type="number" id="qty" name="qty" min="1" placeholder="Masukkan jumlah barang" required>

    <button type="submit">Tambah Detail Transaksi</button>
  </form>
</div>

</body>
</html>
