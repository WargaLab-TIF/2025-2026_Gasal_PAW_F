<?php
include 'core/conn.php';

// Ambil data pelanggan untuk dropdown
$pelanggan_query = mysqli_query($conn, "SELECT * FROM pelanggan");
$pelanggan_data = [];
while ($row = mysqli_fetch_assoc($pelanggan_query)) {
    $pelanggan_data[] = $row;
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = trim($_POST['keterangan']);
    $pelanggan_id = $_POST['pelanggan_id'];
    $user_id = 1; // bisa disesuaikan (misal dari session login)
    $total = 0; // default 0

    $errors = [];

    // Validasi tanggal (tidak boleh kurang dari hari ini)
    $today = date('Y-m-d');
    if ($waktu_transaksi < $today) {
        $errors[] = "Tanggal transaksi tidak boleh kurang dari hari ini.";
    }

    // Validasi panjang keterangan minimal 3 karakter
    if (strlen($keterangan) < 3) {
        $errors[] = "Keterangan minimal 3 karakter.";
    }

    // Validasi pelanggan dipilih
    if (empty($pelanggan_id)) {
        $errors[] = "Silakan pilih pelanggan.";
    }

    // Jika tidak ada error, simpan data
    if (empty($errors)) {
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id)
                  VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id', '$user_id')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='tampil_transaksi.php';</script>";
        } else {
            echo "Gagal menambah transaksi: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f9f9;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 550px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #007b83;
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #bbb;
            border-radius: 8px;
            font-size: 15px;
        }
        button {
            background: #00a896;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background: #028090;
        }
        .error {
            color: #d90429;
            background: #ffe5e5;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Transaksi (Master)</h2>

    <?php
    // tampilkan error jika ada
    if (!empty($errors)) {
        echo "<div class='error'>";
        foreach ($errors as $err) {
            echo "- $err<br>";
        }
        echo "</div>";
    }
    ?>

    <form action="" method="post" onsubmit="return validasiForm()">
        <label for="waktu_transaksi">Waktu Transaksi</label>
        <input type="date" name="waktu_transaksi" id="waktu_transaksi" required>

        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" id="keterangan" rows="3" placeholder="Masukkan keterangan transaksi..." required></textarea>

        <label for="pelanggan_id">Pelanggan</label>
      <select name="transaksi_id" id="transaksi_id">
  <option value="">-- Pilih Transaksi --</option>
  <?php
  $query = "SELECT t.id, t.keterangan, p.nama 
            FROM transaksi t 
            JOIN pelanggan p ON t.pelanggan_id = p.id";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='{$row['id']}'>
            Transaksi #{$row['id']} - {$row['nama']}
            </option>";
  }
  ?>
</select>

        <label>Total</label>
        <input type="number" name="total" value="0">

        <button type="submit" name="simpan">Simpan Transaksi</button>
    </form>
</div>

<script>
function validasiForm() {
    const tanggalInput = document.getElementById('waktu_transaksi').value;
    const keterangan = document.getElementById('keterangan').value.trim();

    const today = new Date();
    const inputDate = new Date(tanggalInput);

    // Validasi tanggal tidak boleh sebelum hari ini
    if (inputDate < new Date(today.toDateString())) {
        alert("Tanggal transaksi tidak boleh sebelum hari ini!");
        return false;
    }

    // Validasi panjang keterangan minimal 3 karakter
    if (keterangan.length < 3) {
        alert("Keterangan minimal 3 karakter!");
        return false;
    }

    return true;
}
</script>

</body>
</html>
