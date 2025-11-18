<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM transaksi WHERE id='$id'"));

if(isset($_POST['update'])){
    $tgl = $_POST['tanggal'];
    $ket = $_POST['keterangan'];
    $pel = $_POST['pelanggan'];
    $total = $_POST['total'];

    mysqli_query($conn,"
        UPDATE transaksi SET 
            waktu_transaksi='$tgl',
            keterangan='$ket',
            total='$total',
            pelanggan_id='$pel'
        WHERE id='$id'
    ");

    echo "<script>alert('Data berhasil diupdate');window.location='master.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
    <link rel='stylesheet' href='assets/style.css'>
</head>
<body>

<h2>Edit Transaksi</h2>

<form method="POST">
    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="<?= $data['waktu_transaksi'] ?>" required><br><br>

    <label>Keterangan</label><br>
    <textarea name="keterangan"><?= $data['keterangan'] ?></textarea><br><br>

    <label>Pelanggan</label><br>
    <select name="pelanggan" required>
        <?php
        $pel = mysqli_query($conn,"SELECT * FROM pelanggan");
        while($p = mysqli_fetch_assoc($pel)){
            $selected = ($data['pelanggan_id'] == $p['id']) ? "selected" : "";
            echo "<option value='$p[id]' $selected>$p[nama]</option>";
        }
        ?>
    </select><br><br>

    <label>Total</label><br>
    <input type="number" name="total" value="<?= $data['total'] ?>" required><br><br>

    <button type="submit" name="update">Update</button>
    <a class="button" href="master.php">Kembali</a>
</form>

</body>
</html>
