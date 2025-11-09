<?php
include "koneksi.php";

$errors = [];
$success = "";

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
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail</title>
</head>
<style>
    body {
        background-color: aqua;
        margin: 7%;
    }

    .layout {
        padding: 5%;
        background-color: white;
    }

    table {
        width: 30%;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        margin-right: auto;
    }

    .lbl {
        width: 40%;
    }

    td {
        padding: 3%;
    }
    .submit{
        color: blue;
    }
</style>

<body>
    <div class="layout">
        <?php foreach ($errors as $err) echo $err . "<br>"; ?>
        <table>
            <form method="POST">
            <tr>
                <th colspan="2">
                    <h2>Tambah Data Detail</h2>
                </th>
            </tr>
            <tr>
                <td class="lbl">
                    <label for="tanggal">waktu transaksi</label>
                </td>
                <td>
                    <input type="date" name="tanggal" value="<?php echo $tanggal?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="keterangan">keterangan</label>
                </td>
                <td>
                    <textarea name="keterangan" id="keterangan" placeholder="Masukkan keterangan..."><?php echo $keterangan?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="total">Total</label>
                </td>
                <td>
                    <input type="text" name="total" id="total" value="0">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="pelanggan_id">Pelanggan</label>
                </td>
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
                <td colspan="2" class="submit">
                    <button type="submit" name="submit">Kirim Data</button>
                </td>
            </tr>
            </form>
        </table>
    </div>
</body>

</html>