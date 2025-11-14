<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tgl = $_POST['waktu_transaksi'];
    $ket = $_POST['keterangan'];
    $pelanggan = $_POST['pelanggan_id'];

    if ($tgl < date('Y-m-d')) {
        echo "<script>alert('Tanggal tidak boleh kurang dari hari ini');history.back();</script>";
        exit;
    }

    if (strlen($ket) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter');history.back();</script>";
        exit;
    }

    mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                            VALUES ('$tgl', '$ket', 0, '$pelanggan')");
    echo "<script>alert('Transaksi berhasil ditambahkan');window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        label {
            display: block;
            margin-top: 8px;
        }
        input, select, textarea {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 10px;
            background-color: green;
            color: white;
            border: none;
            padding: 7px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
<h3>Tambah Transaksi</h3>
<form method="post">
    <label>Tanggal Transaksi</label>
    <input type="date" name="waktu_transaksi" required>

    <label>Keterangan</label>
    <textarea name="keterangan" required></textarea>

    <label>Pelanggan</label>
    <select name="pelanggan_id" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php
        $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($row = mysqli_fetch_assoc($p)) {
            echo "<option value='{$row['id']}'>{$row['nama']}</option>";
        }
        ?>
    </select>

    <button type="submit">Simpan</button>
</form>
</body>
</html>
