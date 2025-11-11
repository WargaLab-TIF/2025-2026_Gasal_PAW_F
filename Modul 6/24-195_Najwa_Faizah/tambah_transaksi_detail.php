<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // Validasi barang_id
    $query = "SELECT * FROM transaksi_detail WHERE transaksi_id = '$transaksi_id' AND barang_id = '$barang_id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "Barang ini sudah ada dalam transaksi.";
        exit;
    }

    // Ambil harga satuan barang
    $query = "SELECT harga FROM barang WHERE id = '$barang_id'";
    $result = mysqli_query($conn, $query);
    $barang = mysqli_fetch_assoc($result);
    $harga = $barang['harga'];

    // Insert data
    $query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
              VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')";
    if (mysqli_query($conn, $query)) {
        // Hitung ulang total transaksi dari detail transaksi
        $query = "SELECT SUM(harga * qty) as total FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];

        // Update total transaksi
        $query = "UPDATE transaksi SET total = '$total' WHERE id = '$transaksi_id'";
        mysqli_query($conn, $query);

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
  <title>Tambah Detail Transaksi</title>
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
    <h2 class="text-center mb-4">Tambah Detail Transaksi</h2>

    <form action="tambah_transaksi_detail.php" method="post">
      <div class="mb-2">
        <label for="barang_id" class="form-label">Pilih Barang</label>
        <select class="form-select" name="barang_id" id="barang_id" required>
          <option value="">Pilih Barang</option>
          <?php
          include 'koneksi.php';
          $query = "SELECT id, nama_barang FROM barang";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['nama_barang']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-2">
        <label for="transaksi_id" class="form-label">ID Transaksi</label>
        <select class="form-select" name="transaksi_id" id="transaksi_id" required>
          <option value="">Pilih ID Transaksi</option>
          <?php
          include 'koneksi.php';
          $query = "SELECT id, waktu_transaksi FROM transaksi";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>ID {$row['id']} - {$row['waktu_transaksi']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-2">
        <label for="qty" class="form-label">Quantity</label>
        <input type="number" class="form-control" name="qty" id="qty" min="1" required placeholder="Masukkan Jumlah Barang">
      </div>

      <button type="submit" class="btn btn-primary w-100 mt-3 mb-4">Tambah Detail Transaksi</button>
    </form>
  </div>
</body>
</html>
