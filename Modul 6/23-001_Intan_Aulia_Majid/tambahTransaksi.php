<?php
include "koneksi.php";

// ambil data pelanggan
$sql = "SELECT * FROM pelanggan";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$today = date("Y-m-d"); // untuk atribut min dan validasi

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $waktuTraksaksi = $_POST["tanggal"];
    $keterangan = trim($_POST["keterangan"]);
    $total = 0;
    $pelanggan = $_POST["pelanggan"];

    // validasi tanggal
    if ($waktuTraksaksi < date("Y-m-d")) {
        echo "<script>alert('Tanggal transaksi tidak boleh kurang dari hari ini!');</script>";
    }
    // validasi keterangan
    elseif (strlen($keterangan) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
    }
    // validasi pelanggan
    elseif (empty($pelanggan)) {
        echo "<script>alert('Silakan pilih pelanggan!');</script>";
    }
    else {
        $sqlTambah = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                      VALUES ('$waktuTraksaksi', '$keterangan', $total, '$pelanggan')";
        mysqli_query($conn, $sqlTambah);
        echo "<script>alert('Data transaksi berhasil ditambahkan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Transaksi</title>
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
      width: 300px;
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

    input[type="date"],
    textarea,
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

    textarea {
      resize: none;
      height: 60px;
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
    <h3>Tambah Data Transaksi</h3>

    <form method="POST" action="">
      <label for="tanggal">Waktu Transaksi</label>
      <input type="date" id="tanggal" name="tanggal" min="<?= $today ?>">

      <label for="keterangan">Keterangan</label>
      <textarea id="keterangan" name="keterangan" placeholder="Masukkan keterangan transaksi"></textarea>

      <label for="total">Total</label>
      <input type="number" id="total" name="total" value="0" readonly>

      <label for="pelanggan">Pelanggan</label>
      <select id="pelanggan" name="pelanggan">
        <option selected disabled value="">Pilih Pelanggan</option>
        <?php foreach($data as $row): ?>
        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
        <?php endforeach; ?>
      </select>

      <button type="submit">Tambah Transaksi</button>
    </form>
  </div>

</body>
</html>
