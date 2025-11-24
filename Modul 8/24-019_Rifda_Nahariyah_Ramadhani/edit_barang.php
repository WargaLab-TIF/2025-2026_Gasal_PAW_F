<?php
include "koneksi.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Barang tidak ditemukan.");
}

$id_barang = mysqli_real_escape_string($koneksi, $_GET['id']);
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang   = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang   = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga         = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok          = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $supplier_id   = mysqli_real_escape_string($koneksi, $_POST['supplier_id']);

    $sql_update = "UPDATE barang SET 
                   kode_barang = '$kode_barang', 
                   nama_barang = '$nama_barang', 
                   harga = '$harga', 
                   stok = '$stok', 
                   supplier_id = '$supplier_id'
                   WHERE id = '$id_barang'";

    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: data_barang.php?status=sukses_edit");
        exit();
    } else {
        $pesan = "<p style='color:red;'>Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}
$sql_barang = "SELECT * FROM barang WHERE id = '$id_barang'";
$result_barang = mysqli_query($koneksi, $sql_barang);

if (mysqli_num_rows($result_barang) == 0) {
    die("Data barang tidak ditemukan.");
}
$data_barang = mysqli_fetch_assoc($result_barang);
$sql_supplier = "SELECT id, nama FROM supplier ORDER BY nama ASC";
$result_supplier = mysqli_query($koneksi, $sql_supplier);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang: <?php echo htmlspecialchars($data_barang['nama_barang']); ?></title>
</head>
<body style="font-family: Arial, sans-serif;">

<table  width="100%" bgcolor="black" cellpadding="10" cellspacing="0">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="data_barang.php" style="color:white; text-decoration:none; "><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>

<h1 align="center">EDIT DATA BARANG</h1>

<?php echo $pesan; ?>
<form action="edit_barang.php?id=<?php echo $id_barang; ?>" method="POST" style="width: 50%; margin: 20px auto; text-align: left;">
    <input type="hidden" name="id" value="<?php echo $id_barang; ?>">
    <table width="70%" cellpadding="5"> 
        <tr>
            <td width="30%"><label for="kode_barang">Kode Barang</label></td>
            <td width="60%"><input type="text" id="kode_barang" name="kode_barang" value="<?php echo htmlspecialchars($data_barang['kode_barang']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="nama_barang">Nama Barang</label></td>
            <td><input type="text" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($data_barang['nama_barang']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="harga">Harga (Rp)</label></td>
             <td><input type="number" id="harga" name="harga" value="<?php echo htmlspecialchars($data_barang['harga']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="stok">Stok</label></td>
            <td><input type="number" id="stok" name="stok" value="<?php echo htmlspecialchars($data_barang['stok']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="supplier_id">Supplier</label></td>
            <td>
                <select id="supplier_id" name="supplier_id" required style="width: 62%;">
                    <option value="">-- Pilih Supplier --</option>
                    <?php
                    while ($supplier = mysqli_fetch_assoc($result_supplier)) {
                        $selected = ($supplier['id'] == $data_barang['supplier_id']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($supplier['id']) . "' {$selected}>" . htmlspecialchars($supplier['nama']) . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 15px;">
                <button type="submit" style="padding: 10px 20px; background-color: limegreen; color: white; border: none; cursor: pointer; border-radius: 4px;"><b>Simpan Perubahan</b></button>
                <a href="data_barang.php" style="margin-left: 10px; padding: 9px 20px; text-decoration: none; color: white; background-color: red; border-radius: 4px;"><b>Batal</b></a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>