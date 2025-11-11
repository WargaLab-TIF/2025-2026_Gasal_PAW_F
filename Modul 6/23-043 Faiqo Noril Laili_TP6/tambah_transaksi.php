<?php
include "koneksi.php";
$p_id_s = mysqli_query($conn, "SELECT id FROM pelanggan");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = 0;
    $tanggal = $_POST["waktu"];
    $keterangan = $_POST["keterangan"];
    $total = $_POST["total"];

    if (isset($_POST["pelanggan"])) {
        $pelanggan = $_POST["pelanggan"];
    } else {
        echo "Harap pilih pelanggan <br>";
        $error += 1;
    }

    if ($tanggal < date("Y-m-d")) {
        echo "Tanggal transaksi tidak boleh kurang dari tanggal saat ini <br>";
        $error += 1;
    }

    if (strlen(trim($keterangan)) < 3) {
        echo "Panjang keterangan minimal 3 karakter <br>";
        $error += 1;
    }

    if ($error == 0) {
        if (mysqli_query($conn, "INSERT INTO transaksi(waktu_transaksi, keterangan, total, pelanggan_id)
        VALUES ('$tanggal', '$keterangan', '$total', '$pelanggan')")) {
            echo "Berhasil";
            header("location: index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .form-container input, .form-container textarea, .form-container select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Data Transaksi</h2>
    <form action="tambah_transaksi.php" method="post">
        <label for="waktu">Waktu Transaksi</label>
        <input type="date" name="waktu" id="waktu" required>

        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" id="keterangan" placeholder="Masukkan keterangan transaksi" required></textarea>

        <label for="total">Total</label>
        <input type="number" name="total" id="total" value="0" readonly>

        <label for="pelanggan">Pelanggan</label>
        <select name="pelanggan" id="pelanggan" required>
            <option disabled selected>Pilih Pelanggan</option>
            <?php while ($id = mysqli_fetch_assoc($p_id_s)) {
                echo "<option value='{$id['id']}'>{$id['id']}</option>";
            } ?>
        </select>

        <button type="submit" name="submit">Tambah Transaksi</button>
    </form>
</div>

</body>
</html>
