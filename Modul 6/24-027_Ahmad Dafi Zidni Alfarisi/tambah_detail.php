<?php
include "koneksi.php";

$errors = [];
$success = "";

$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
$total = isset($_POST['total']) ? $_POST['total'] : '0';

if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $keterangan = trim($_POST['keterangan']);
    $total = $_POST['total'];
    $pelanggan_id = $_POST['pelanggan_id'];

    if (empty($tanggal)) {
        $errors[] = "Tanggal transaksi wajib diisi.";
    } elseif ($tanggal < date('Y-m-d')) {
        $errors[] = "Tanggal transaksi tidak boleh sebelum hari ini.";
    }

    if (strlen($keterangan) < 3) {
        $errors[] = "Keterangan minimal 3 karakter.";
    }

    if (empty($pelanggan_id)) {
        $errors[] = "Pelanggan wajib dipilih.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$tanggal', '$keterangan', '$total', '$pelanggan_id')";
        mysqli_query($conn, $sql);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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

    input, textarea, select {
        width: 100%;
        padding: 7px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    textarea {
        height: 70px;
    }

    .btn-submit {
        background: #28a745;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        border: none;
        width: 100%;
        cursor: pointer;
        font-size: 15px;
    }

    .btn-submit:hover {
        background: #218838;
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
        <h2>Tambah Transaksi</h2>

        <?php if (!empty($errors)) { ?>
            <div class="error-box">
                <?php foreach ($errors as $err) echo "- $err<br>"; ?>
            </div>
        <?php } ?>

        <form method="POST">
        <table>
            <tr>
                <td><label for="tanggal">Waktu Transaksi</label></td>
                <td><input type="date" name="tanggal" value="<?= $tanggal ?>"></td>
            </tr>

            <tr>
                <td><label for="keterangan">Keterangan</label></td>
                <td><textarea name="keterangan" id="keterangan" placeholder="Masukkan keterangan..."><?= $keterangan ?></textarea></td>
            </tr>

            <tr>
                <td><label for="total">Total</label></td>
                <td><input type="text" name="total" id="total" value="<?= $total ?>"></td>
            </tr>

            <tr>
                <td><label for="pelanggan_id">Pelanggan</label></td>
                <td>
                    <select name="pelanggan_id">
                        <option value="">-- Pilih pelanggan --</option>
                        <?php
                        $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
                        while ($row = mysqli_fetch_assoc($pelanggan)) {
                            $selected = (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] == $row['id']) ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>{$row['nama']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" class="btn-submit" name="submit">Simpan Transaksi</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
</body>

</html>
