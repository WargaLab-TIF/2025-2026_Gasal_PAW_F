<?php

include "koneksi.php";

$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$transaksi = "SELECT * FROM transaksi";
$resultTransaksi = mysqli_query($conn, $transaksi);
$dataTransaksi = mysqli_fetch_all($resultTransaksi, MYSQLI_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $idBarang = $_POST['barang'];
  $idTransaksi = $_POST['transaksi'];
  $qty = $_POST['qty'];
  $queryHargaBarang = "SELECT harga FROM barang WHERE id = $idBarang";

  $hargaBarang = mysqli_query($conn, $queryHargaBarang);
  $hargaBarangHasil = mysqli_fetch_assoc($hargaBarang);
  $hargaTotal = $hargaBarangHasil['harga'] * $qty;


  $cekBarang = "SELECT * FROM transaksi_detail WHERE transaksi_id = $idTransaksi AND barang_id = $idBarang";
  $hasilCek = mysqli_query($conn, $cekBarang);

  if (mysqli_num_rows($hasilCek) > 0) {
    header("location: index.php");
    exit();
  }

  $sql = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ($idTransaksi, $idBarang, $hargaTotal, $qty)";

  if(mysqli_query($conn, $sql)){
    $sqlUpdateTotal = "UPDATE transaksi SET total = total + $hargaTotal WHERE id = $idTransaksi";
    mysqli_query($conn, $sqlUpdateTotal);

    header("location: index.php" );
  } else {
    header("location: index.php" );
  }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Detail Transaksi</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f7f9fc;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background: #fff;
      padding: 20px 25px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      width: 400px;
    }

    .card .status {
      display: flex;
      justify-content: center;
    }

    .card h3 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 16px;
    }

    label {
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 5px;
      display: block;
    }

    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 8px 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background-color: #0056d2;
    }
  </style>
</head>
<body>
  
  <div class="card">
    <span class="status"><?php if(isset($_GET['status'])){ echo($_GET['status']); }?></span>
    <h3>Tambah Detail Transaksi</h3>
    <form method="POST" action="">
      <label for="barang">Pilih Barang</label>
      <select id="barang" name="barang">
        <option selected disabled>Pilih Barang</option>
        <?php foreach($data as $row):?>
          <option value="<?= $row['id'] ?>"><?= $row['nama_barang']?></option>
        <?php endforeach; ?>
      </select>

      <label for="transaksi">ID Transaksi</label>
      <select id="transaksi" name="transaksi">
        <option selected disabled>Pilih ID Transaksi</option>
        <?php foreach($dataTransaksi as $rowTransaksi):?>
          <option value="<?= $rowTransaksi['id'] ?>"><?= $rowTransaksi['id'] ?></option>
        <?php endforeach;?>
      </select>

      <label for="qty">Quantity</label>
      <input type="number" id="qty" name="qty" placeholder="Masukkan jumlah barang" min="1">

      <button type="submit">Tambah Detail Transaksi</button>
    </form>
  </div>

</body>
</html>
