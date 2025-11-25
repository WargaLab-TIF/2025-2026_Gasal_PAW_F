<?php

    include "../../koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $waktu_transaksi = $_POST["waktu_transaksi"];
        $keterangan = $_POST["keterangan"];
        $total = $_POST["total"];
        $pelanggan_id = $_POST["pelanggan_id"];

        $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";
        if (mysqli_query($conn, $sql)) {
            header("location: transaksi.php");
        }
    }

    $query_pelanggan = "SELECT id, nama FROM pelanggan";
    $result_pelanggan = mysqli_query($conn, $query_pelanggan);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/inputStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <label for="waktu_transaksi">Waktu Transaksi: </label><br>
            <input type="date" name="waktu_transaksi" id="waktu_transaksi"><br><br>
            
            <label for="keterangan">Keterangan: </label><br>
            <textarea name="keterangan" id="keterangan"></textarea><br><br>
                        
            <label for="total">Total: </label><br>
            <input type="number" name="total" id="total"><br><br>

            <label for="pelanggan_id">Pelanggan: </label><br>
            <select name="pelanggan_id" id="pelanggan_id" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php
                if (mysqli_num_rows($result_pelanggan) > 0) {
                    while ($row = mysqli_fetch_assoc($result_pelanggan)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                    }
                }
                ?>
            </select><br><br>
            
            <button type="submit" name="submit" id="submit">Simpan</button>
            <button type="button" onclick="window.location.href='transaksi.php'">Batal</button>
        </form>
    </div>
</body>
</html>