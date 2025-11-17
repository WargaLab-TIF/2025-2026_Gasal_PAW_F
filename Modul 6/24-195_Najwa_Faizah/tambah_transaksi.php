<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];
    $pelanggan_id = $_POST['pelanggan_id'];

    // Validasi waktu transaksi
    if ($waktu_transaksi < date('Y-m-d')) {
        echo "Tanggal tidak boleh kurang dari hari ini.";
        exit;
    }

    // Validasi keterangan
    if (strlen($keterangan) < 3) {
        echo "Keterangan minimal 3 karakter.";
        exit;
    }

    // Validasi total
    if ($total < 0) {
        echo "Total tidak boleh kurang dari 0.";
        exit;
    }

    // Insert data
    $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
              VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      max-width: 500px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      margin: auto;
      padding: 20px;
      border-radius: 8px;
      background-color: #e9ecef;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h4 class="text-center mb-4">Tambah Data Transaksi</h4>

    <form action="tambah_transaksi.php" method="post">
      <div class="mb-2">
        <label for="waktu_transaksi" class="form-label">Waktu Transaksi</label>
        <input type="date" class="form-control" id="waktu_transaksi" name="waktu_transaksi" required>
      </div>

      <div class="mb-2">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required placeholder="Masukkan Keterangan Transaksi"></textarea>
      </div>

      <div class="mb-2">
        <label for="total" class="form-label">Total</label>
        <input type="number" class="form-control" id="total" name="total" required placeholder="0" min="0">
      </div>

      <div class="mb-2">
        <label for="pelanggan_id" class="form-label">Pelanggan</label>
        <select class="form-control" id="pelanggan_id" name="pelanggan_id" required>
          <?php
          $query = "SELECT * FROM pelanggan";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['nama']}</option>";
          }
          ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary w-100 mt-3 mb-4">Tambah Transaksi</button>
    </form>
  </div>
</body>
</html>
