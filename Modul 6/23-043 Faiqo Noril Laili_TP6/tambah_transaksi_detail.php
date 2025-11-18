<?php
include "koneksi.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil data transaksi dan barang
$t_id_s = mysqli_query($conn, "SELECT id, waktu_transaksi FROM transaksi ORDER BY id DESC");
$b_id_s = mysqli_query($conn, "SELECT id, nama_barang AS nama, harga FROM barang ORDER BY id"); // sesuaikan kolom nama_barang jika perlu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = 0;
    $barang = $_POST["barang_id"];
    $transaksi = $_POST["transaksi_id"];
    $qty = $_POST["qty"];

    // Cek duplikasi barang dalam transaksi
    $cek = mysqli_query($conn, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = '$transaksi' AND barang_id = '$barang'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang sudah ditambahkan pada transaksi ini!');</script>";
        $error++;
    }

    if ($error == 0) {
        // Ambil harga satuan barang
        $hasil = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$barang'");
        if ($harga_data = mysqli_fetch_assoc($hasil)) {
            $total = $qty * $harga_data["harga"];

            // Simpan ke transaksi_detail
            $insert = mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) 
                                           VALUES ('$transaksi', '$barang', '$qty', '$total')");

            if ($insert) {
                // Update total di tabel transaksi
                mysqli_query($conn, "UPDATE transaksi 
                    SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = '$transaksi')
                    WHERE id = '$transaksi'");

                echo "<script>alert('Detail transaksi berhasil ditambahkan!');window.location='index.php';</script>";
                exit();
            } else {
                echo "<script>alert('Gagal menambahkan detail transaksi.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 450px;
            background: #fff;
            margin: 50px auto;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Detail Transaksi</h2>
    <form method="post">

        <label for="transaksi_id">Pilih Transaksi</label>
        <select name="transaksi_id" required>
            <option value="" disabled selected>-- Pilih Transaksi --</option>
            <?php while ($t = mysqli_fetch_assoc($t_id_s)) { ?>
                <option value="<?= $t['id'] ?>">Transaksi ID <?= $t['id'] ?> - <?= $t['waktu_transaksi'] ?></option>
            <?php } ?>
        </select>

        <label for="barang_id">Pilih Barang</label>
        <select name="barang_id" required>
            <option value="" disabled selected>-- Pilih Barang --</option>
            <?php while ($b = mysqli_fetch_assoc($b_id_s)) { ?>
                <option value="<?= $b['id'] ?>"><?= $b['nama'] ?> - Rp<?= number_format($b['harga'],0,',','.') ?></option>
            <?php } ?>
        </select>

        <label for="qty">Jumlah (Qty)</label>
        <input type="number" name="qty" min="1" required>

        <button type="submit">Simpan Detail</button>
        <a href="index.php">← Kembali ke Halaman Utama</a>
    </form>
</div>

</body>
</html>
