<?php
include 'koneksi.php';

$err_nama = $err_telp = $err_alamat = "";
$nama = $telp = $alamat = "";
$row = [];

if (isset($_GET['no'])) {
    $no = $_GET['no'];
    $query = mysqli_query($conn, "SELECT * FROM master_supllier WHERE no = $no");
    $row = mysqli_fetch_assoc($query);
    $nama = $row['nama'];
    $telp = $row['telp'];
    $alamat = $row['alamat'];
}

if (isset($_POST['update'])) {
    $no = $_POST['no'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
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

    // Validasi telp
    if (empty($telp)) {
        $err_telp = "Nomor telepon tidak boleh kosong";
        $valid = false;
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $err_telp = "Nomor hanya boleh angka";
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

    // Jika semua valid, lakukan update
    if ($valid) {
        $update = "UPDATE master_supllier 
                   SET nama='$nama', telp='$telp', alamat='$alamat' 
                   WHERE no='$no'";
        if (mysqli_query($conn, $update)) {
            header('location:tampilkan.php');
        } else {
            echo "<p style='color:red;'>Gagal memperbarui data: " . mysqli_error($conn) . "</p>";
        }
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
<form action="" method="POST" class="card">
    <h2>FORM UPDATE DATA</h2>

    <input type="hidden" name="no" value="<?php echo $row['no']; ?>"> <br>

    <label>Nama :</label><br>
    <?php if($err_nama) echo "<span style='color:red;'>$err_nama</span><br>"; ?>
    <input type="text" name="nama" value="<?php echo $nama; ?>"><br><br>

    <label>Telp :</label><br>
    <?php if($err_telp) echo "<span style='color:red;'>$err_telp</span><br>"; ?>
    <input type="number" name="telp" value="<?php echo $telp; ?>"><br><br>

    <label>Alamat :</label><br>
    <?php if($err_alamat) echo "<span style='color:red;'>$err_alamat</span><br>"; ?>
    <input type="text" name="alamat" value="<?php echo $alamat; ?>"><br><br>

    <input type="submit" name="update" value="Simpan Perubahan">
    <a href="tampilkan.php">Batal?</a>
</form>    
</body>
</html>
