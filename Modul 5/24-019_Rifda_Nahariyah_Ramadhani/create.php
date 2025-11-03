<?php
include "koneksi.php";

$nama = $telp = $alamat = "";
$error_nama = $error_telp = $error_alamat = "";
$valid = true; 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = trim($_POST["nama"]);
    $telp = trim($_POST["telp"]);
    $alamat = trim($_POST["alamat"]);

    if (empty($nama)) {
        $error_nama = "Nama tidak boleh kosong.";
        $valid = false;
    }elseif (!preg_match("/^[a-zA-Z\s\.'\-]+$/", $nama)) {
        $error_nama = "Nama hanya boleh mengandung huruf, spasi, titik, apostrof, atau strip.";
        $valid = false;
    }

    if (empty($telp)) {
        $error_telp = "Nomor Telepon tidak boleh kosong.";
        $valid = false;
    }elseif (!ctype_digit($telp)) {
        $error_telp = "Nomor Telepon hanya boleh mengandung angka.";
        $valid = false;
    }

    if (empty($alamat)) {
        $error_alamat = "Alamat tidak boleh kosong.";
        $valid = false;
    }elseif (!preg_match("/^[a-zA-Z0-9\s,\.\/-]+$/", $alamat)){
        $error_alamat = "Alamat mengandung karakter yang tidak diizinkan. Hanya huruf, angka, spasi, koma, titik, strip, atau garis miring.";
        $valid = false;
    }

    if ($valid) {
        $nama = mysqli_real_escape_string($conn, $nama);
        $telp = mysqli_real_escape_string($conn, $telp);
        $alamat = mysqli_real_escape_string($conn, $alamat);

        $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        
        if(mysqli_query($conn, $sql)){
            header("location: index.php");
        } else {
            echo "<p style='color: red; font-family: Arial;'>Gagal menyimpan data ke database: " . mysqli_error($conn) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2 style="font-family: Arial;">Tambah Data Master Supplier Baru</h2>
    <form action="create.php" method="POST">
        <table style="width: 50%;">
            <tr>
                <td><label for="nama" style="font-weight: bold;">Nama</label></td>
                <td><input type="text" name="nama" id="nama" placeholder="Nama" value="<?php echo htmlspecialchars($nama); ?>" 
                           style="padding: 8px; width: 50%; border: 1px solid black; border-radius: 4px; box-sizing: border-box;">
                    <?php if ($error_nama): ?>
                        <div style="color: red; font-size: 14px; margin-top: 5px;"><?php echo $error_nama; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><label for="telp" style="font-weight: bold;">Telp</label></td>
                <td><input type="text" name="telp" id="telp" placeholder="Telp" value="<?php echo htmlspecialchars($telp); ?>" 
                           style="padding: 8px; width: 50%; border: 1px solid black; border-radius: 4px; box-sizing: border-box;">
                    <?php if ($error_telp): ?>
                        <div style="color: red; font-size: 14px; margin-top: 5px;"><?php echo $error_telp; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><label for="alamat" style="font-weight: bold;">Alamat</label></td>
                <td>
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo htmlspecialchars($alamat); ?>" 
                           style="padding: 8px; width: 50%; border: 1px solid black; border-radius: 4px; box-sizing: border-box;">
                    <?php if ($error_alamat): ?>
                        <div style="color: red; font-size: 14px; margin-top: 5px;"><?php echo $error_alamat; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td> 
                <td style="padding-top: 20px; width: 85%;">
                    <button type="submit" 
                    style="background-color: limegreen; color: white; padding: 8px 15px; border-radius: 3px; cursor: pointer; border: none; font-size: 14px; margin-right: 10px;">
                    <b>Simpan</b>
                    </button>
                    
                    <a href="index.php" 
                    style="background-color: red; color: white; padding: 8px 20px; border-radius: 3px; cursor: pointer; border: none; font-size: 14px; text-decoration: none;">
                    <b>Batal</b>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>