<?php
include "koneksi.php";

$errors = [];
$success = "";

$barang_id = isset($_POST['barang_id']) ? $_POST['barang_id'] : '';
$transaksi_id = isset($_POST['transaksi_id']) ? $_POST['transaksi_id'] : '';
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';

if (isset($_POST['submit'])) {
    $barang_id = $_POST['barang_id'];
    $transaksi_id = $_POST['transaksi_id'];
    $jumlah = $_POST['jumlah'];

    if (empty($transaksi_id)) {
        $errors[] = "Transaksi wajib dipilih.";
    }

    if (empty($barang_id)) {
        $errors[] = "Barang wajib dipilih.";
    }

    if (empty($jumlah) || $jumlah <= 0) {
        $errors[] = "Jumlah harus lebih dari 0.";
    }

    if (empty($errors)) {
        $cek = mysqli_query($conn, "
            SELECT * FROM transaksi_detail 
            WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'
        ");
        if (mysqli_num_rows($cek) > 0) {
            $errors[] = "Barang ini sudah ditambahkan pada transaksi tersebut.";
        }
    }

    if (empty($errors)) {
        $barang = mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barang_id'");
        $data = mysqli_fetch_assoc($barang);

        if ($data) {
            $harga = $data['harga'];
            $total = $harga * $jumlah;

            $sql = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                    VALUES ('$transaksi_id', '$barang_id', '$total', '$jumlah')";
            mysqli_query($conn, $sql);

            $total_query = mysqli_query($conn, "SELECT SUM(harga) AS total FROM transaksi_detail WHERE transaksi_id='$transaksi_id'");
            $total_data = mysqli_fetch_assoc($total_query);
            $total_baru = $total_data['total'];
            mysqli_query($conn, "UPDATE transaksi SET total='$total_baru' WHERE id='$transaksi_id'");

            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
</head>

<style>
    body {
        background: #eef3f7;
        margin: 3%;
        font-family: Arial, sans-serif;
    }

    .layout {
        padding: 25px;
        background: white;
        border-radius: 10px;
        width: 50%;
        margin: auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    table {
        width: 100%;
    }

    td {
        padding: 10px 0;
    }

    input, select {
        width: 100%;
        padding: 7px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .btn-submit {
        background: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        border: none;
        width: 100%;
        cursor: pointer;
        font-size: 15px;
    }

    .btn-submit:hover {
        background: #0056b3;
    }

    .error-box {
        background: #ffd7d7;
        border-left: 5px solid #d8000c;
        padding: 10px;
        margin-bottom: 15px;
        color: #333;
        border-radius: 5px;
    }
</style>

<body>
    <div class="layout">
        <h2>Tambah Detail Transaksi</h2>

        <?php if (!empty($errors)) { ?>
            <div class="error-box">
                <?php foreach ($errors as $err) echo "- $err<br>"; ?>
            </div>
        <?php } ?>

        <form method="POST">
        <table>
            <tr>
                <td><label for="barang_id">Pilih Barang</label></td>
                <td>
                    <select name="barang_id">
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $barang = mysqli_query($conn, "SELECT * FROM barang");
                        while ($row = mysqli_fetch_assoc($barang)) {
                            $selected = ($barang_id == $row['id']) ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>{$row['nama_barang']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="transaksi_id">Pilih Transaksi</label></td>
                <td>
                    <select name="transaksi_id">
                        <option value="">-- Pilih ID Transaksi --</option>
                        <?php
                        $transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
                        while ($row = mysqli_fetch_assoc($transaksi)) {
                            $selected = ($transaksi_id == $row['id']) ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>{$row['id']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="jumlah">Quantity</label></td>
                <td><input type="text" name="jumlah" value="<?= $jumlah ?>" placeholder="Masukkan jumlah barang..."></td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" name="submit" class="btn-submit">Simpan Detail Transaksi</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
</body>

</html>
