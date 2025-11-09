<?php
include "koneksi.php";

$errors = [];
$success = "";

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
    <title>Transaksi Detail</title>
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

    .submit {
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
                        <h2>Tambah Detail Transaksi</h2>
                    </th>
                </tr>
                <tr>
                    <td>
                        <label for="barang_id">Pilih Barang</label>
                    </td>
                    <td>
                        <select name="barang_id">
                            <option value="">-- Pilih barang --</option>
                            <?php
                            $barang = mysqli_query($conn, "SELECT * FROM barang");
                            while ($row = mysqli_fetch_assoc($barang)) {
                                $selected = (isset($_POST['barang_id']) && $_POST['barang_id'] == $row['id']) ? 'selected' : '';
                                echo "<option value='{$row['id']}' $selected>{$row['nama_barang']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="transaksi_id">ID transaksi</label>
                    </td>
                    <td>
                        <select name="transaksi_id">
                            <option value="">-- Pilih ID transaksi --</option>
                            <?php
                            $transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
                            while ($row = mysqli_fetch_assoc($transaksi)) {
                                $selected = (isset($_POST['transaksi_id']) && $_POST['transaksi_id'] == $row['id']) ? 'selected' : '';
                                echo "<option value='{$row['id']}' $selected>{$row['id']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="jumlah">Quantity</label>
                    </td>
                    <td>
                        <input type="text" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah Barang">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="submit">
                        <button type="submit" name="submit">Tambah Detail Transaksi</button>
                    </td>
                </tr>
            </form>
        </table>
    </div>
</body>

</html>
