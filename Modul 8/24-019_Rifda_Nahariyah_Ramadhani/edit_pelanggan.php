<?php
include "koneksi.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Pelanggan tidak ditemukan.");
}

$id_pelanggan = mysqli_real_escape_string($koneksi, $_GET['id']);
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp          = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $sql_update = "UPDATE pelanggan SET nama = '$nama', jenis_kelamin = '$jenis_kelamin',alamat = '$alamat', telp = '$telp'
                   WHERE id = '$id_pelanggan'";

    if (mysqli_query($koneksi, $sql_update)) {

        header("Location: data_pelanggan.php?status=sukses_edit");
        exit();
    } else {
        $pesan = "<p style='color:red;'>Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}

$sql_pelanggan = "SELECT * FROM pelanggan WHERE id = '$id_pelanggan'";
$result_pelanggan = mysqli_query($koneksi, $sql_pelanggan);

if (mysqli_num_rows($result_pelanggan) == 0) {
    die("Data pelanggan tidak ditemukan.");
}
$data_pelanggan = mysqli_fetch_assoc($result_pelanggan);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan: <?php echo htmlspecialchars($data_pelanggan['nama']); ?></title>
</head>
<body style="font-family: Arial, sans-serif;">

<table  width="100%" bgcolor="black" cellpadding="10" cellspacing="0">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="data_pelanggan.php" style="color:white; text-decoration:none; "><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>

<h1 align="center">EDIT DATA PELANGGAN</h1>
<?php echo $pesan; ?>
<form action="edit_pelanggan.php?id=<?php echo $id_pelanggan; ?>" method="POST" style="width: 50%; margin: 20px auto; text-align: left;">

    <table width="80%" cellpadding="5"> 
        <tr>
            <td width="30%"><label for="nama">Nama Pelanggan</label></td>
            <td width="70%"><input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data_pelanggan['nama']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="jenis_kelamin">Jenis Kelamin</label></td>
            <td>
                <select id="jenis_kelamin" name="jenis_kelamin" required style="width: 62%;">
                    <?php 
                        $jk_saat_ini = htmlspecialchars($data_pelanggan['jenis_kelamin']);
                        $laki_laki_selected = ($jk_saat_ini == 'Laki-laki') ? 'selected' : '';
                        $perempuan_selected = ($jk_saat_ini == 'Perempuan') ? 'selected' : '';
                    ?>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" <?php echo $laki_laki_selected; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo $perempuan_selected; ?>>Perempuan</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td>
                <textarea id="alamat" name="alamat" required style="width: 60%; height: 80px;"><?php echo htmlspecialchars($data_pelanggan['alamat']); ?></textarea>
            </td>
        </tr>
        <tr>
            <td><label for="telp">Telepon</label></td>
            <td><input type="text" id="telp" name="telp" value="<?php echo htmlspecialchars($data_pelanggan['telp']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 15px;">
                <button type="submit" style="padding: 10px 20px; background-color: limegreen; color: white; border: none; cursor: pointer; border-radius: 4px;"><b>Simpan Perubahan</b></button>
                <a href="data_pelanggan.php" style="margin-left: 10px; padding: 9px 20px; text-decoration: none; color: white; background-color: red; border-radius: 4px;"><b>Batal</b></a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>