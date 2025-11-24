<?php
include "koneksi.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Supplier tidak ditemukan.");
}

$id_supplier = mysqli_real_escape_string($koneksi, $_GET['id']);
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $sql_update = "UPDATE supplier SET 
                   nama = '$nama', 
                   alamat = '$alamat', 
                   telp = '$telp'
                   WHERE id = '$id_supplier'";

    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: data_supplier.php?status=sukses_edit");
        exit();
    } else {
        $pesan = "<p style='color:red;'>Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}

$sql_supplier = "SELECT * FROM supplier WHERE id = '$id_supplier'";
$result_supplier = mysqli_query($koneksi, $sql_supplier);

if (mysqli_num_rows($result_supplier) == 0) {
    die("Data supplier tidak ditemukan.");
}
$data_supplier = mysqli_fetch_assoc($result_supplier);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Supplier: <?php echo htmlspecialchars($data_supplier['nama']); ?></title>
</head>
<body style="font-family: Arial, sans-serif;">

<table  width="100%" bgcolor="black" cellpadding="10" cellspacing="0">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="data_supplier.php" style="color:white; text-decoration:none; "><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>
<h1 align="center">EDIT DATA SUPPLIER</h1>
<?php echo $pesan; ?>
<form action="edit_supplier.php?id=<?php echo $id_supplier; ?>" method="POST" style="width: 50%; margin: 20px auto; text-align: left;">

    <table width="80%" cellpadding="5"> 
        <tr>
            <td width="30%"><label for="nama">Nama Supplier</label></td>
            <td width="70%"><input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data_supplier['nama']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td>
                <textarea id="alamat" name="alamat" required style="width: 60%; height: 80px;"><?php echo htmlspecialchars($data_supplier['alamat']); ?></textarea>
            </td>
        </tr>
        <tr>
            <td><label for="telp">Telepon</label></td>
            <td><input type="text" id="telp" name="telp" value="<?php echo htmlspecialchars($data_supplier['telp']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 15px;">
                <button type="submit" style="padding: 10px 20px; background-color: limegreen; color: white; border: none; cursor: pointer; border-radius: 4px;"><b>Simpan Perubahan</b></button>
                <a href="data_supplier.php" style="margin-left: 10px; padding: 9px 20px; text-decoration: none; color: white; background-color: red; border-radius: 4px;"><b>Batal</b></a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>