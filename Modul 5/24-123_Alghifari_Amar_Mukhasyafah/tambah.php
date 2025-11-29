<?php
include 'koneksi.php';

$nama = "";
$nomor = "";
$alamat = "";
$err_nama = "";
$err_nomor = "";
$err_alamat = "";

if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];
    $alamat = $_POST['alamat'];
    $valid = true;

    // Validasi nama
    if (empty($nama)) {
        $err_nama = "Nama tidak boleh kosong";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $err_nama = "Nama hanya boleh huruf";
        $valid = false;
    }

    // Validasi nomor
    if (empty($nomor)) {
        $err_nomor = "Nomor telepon tidak boleh kosong";
        $valid = false;
    } elseif (!preg_match("/^[0-9]+$/", $nomor)) {
        $err_nomor = "Nomor hanya boleh angka";
        $valid = false;
    }

    // Validasi alamat
    if (empty($alamat)) {
        $err_alamat = "Alamat tidak boleh kosong";
        $valid = false;
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*[0-9]).+$/", $alamat)) {
        $err_alamat = "Alamat harus mengandung huruf dan angka";
        $valid = false;
    }

    // Jika validasi benar semua
    if ($valid) {
        $result = "INSERT INTO master_supllier (nama,telp,alamat) 
        VALUES ('$nama','$nomor','$alamat')";
        mysqli_query($conn,$result);
        $nama = $nomor = $alamat = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <div class="card">
    <form action="" method="post">
    <h2>FORM TAMBAH DATA</h2>

    <label>Nama :</label><br>
    <?php if($err_nama) echo "<span style='color:red;'>$err_nama</span><br>"; ?>
    <input type="text" name="nama" placeholder="masukkan nama anda" value="<?php echo $nama; ?>"><br><br>

    <label>Telp :</label><br>
    <?php if($err_nomor) echo "<span style='color:red;'>$err_nomor</span><br>"; ?>
    <input type="number" name="nomor" placeholder="Masukkan Nomor Telepon Anda" value="<?php echo $nomor; ?>"><br><br>

    <label>Alamat :</label><br>
    <?php if($err_alamat) echo "<span style='color:red;'>$err_alamat</span><br>"; ?>
    <input type="text" name="alamat" placeholder="masukkan alamat anda" value="<?php echo $alamat; ?>"><br><br>

    <div class="flex">
    <input type="submit" name="submit" value="Simpan">
    <a href="tampilkan.php">Lihat Data?</a>
    </div>
    </form>
    </div>
</body>
</html>
