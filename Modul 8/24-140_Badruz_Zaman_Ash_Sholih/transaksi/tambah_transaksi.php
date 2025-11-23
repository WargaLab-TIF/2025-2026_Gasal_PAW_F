<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION["user_id"] ?? 1;
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];

    if ($waktu_transaksi < date('Y-m-d')) {
        echo "<script>alert('Tanggal transaksi tidak boleh kurang dari hari ini!');</script>";
    } else if (strlen(trim($keterangan)) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
    } else {
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id)
        VALUES ('$waktu_transaksi', '$keterangan', 0, '$pelanggan_id', '$user_id')";
        mysqli_query($conn, $query);

        $last_id = mysqli_insert_id($conn);

        header("Location: tambah_transaksi_detail.php?transaksi_id=$last_id");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <style>
        body {
            font-family: verdana;
            background: #f1f3f6;
            padding: 20px;
        }

        .container {
            width: 400px;
            background: white;
            margin: auto;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 12px;
        }

        textarea {
            height: 70px;
            resize: none;
        }

        .btn-submit {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #0056b3;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Transaksi</h2>

    <form method="POST">

        <label>Waktu Transaksi</label>
        <input type="date" name="waktu_transaksi" required>

        <label>Pelanggan</label>
        <select name="pelanggan_id" required>
            <option value="">-- Pilih --</option>
            <?php while($p = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
            <?php } ?>
        </select>

        <label>Keterangan</label>
        <textarea name="keterangan" required></textarea>

        <button type="submit" class="btn-submit" >Simpan</button>
    </form>
    
    <a class="btn-back" href="./transaksi.php">Kembali</a>
</div>

</body>
</html>