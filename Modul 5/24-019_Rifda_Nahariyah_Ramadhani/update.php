<?php
include "koneksi.php";

$nama = $telp = $alamat = "";
$error_nama = $error_telp = $error_alamat = "";
$valid = true; 
$nomor = ''; 

$result = [
    'no'    => "", 
    'nama'  => "",
    'telp'  => "",
    'alamat' => ""
];

if(isset($_GET['no']) && $_SERVER["REQUEST_METHOD"] != "POST"){
    $nomor_get = $_GET['no'];
    
    $nomor = mysqli_real_escape_string($conn, $nomor_get);
    
    $sql = "SELECT * FROM supplier WHERE id = '$nomor'";
    $query = mysqli_query($conn, $sql);
    
    if ($query && mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);
        $nomor = $result['id']; 
    } else { 
        header("location: index.php");
        exit();
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nomor  = trim($_POST['no'] ?? ''); 
    $nama   = trim($_POST['nama'] ?? '');
    $telp   = trim($_POST['telp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

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
    } elseif (!ctype_digit($telp)) {
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
        $nama   = mysqli_real_escape_string($conn, $nama);
        $telp   = mysqli_real_escape_string($conn, $telp);
        $alamat = mysqli_real_escape_string($conn, $alamat);

        $nomor_bersih = mysqli_real_escape_string($conn, $nomor);

        $sql_update = "UPDATE supplier 
                       SET nama = '$nama', telp = '$telp', alamat = '$alamat' 
                       WHERE id = '$nomor_bersih'";
        
        if(mysqli_query($conn, $sql_update)){
            header("location: index.php");
            exit(); 
        } else {
            echo "<p style='color: red; font-family: Arial;'>Error mengupdate data: " . mysqli_error($conn) . "</p>";
        }
    }

    $result = [
        'no'    => $nomor, 
        'nama'  => $nama,
        'telp'  => $telp,
        'alamat' => $alamat
    ];
}
else {
    header("location: index.php");
    exit();
}

if (!empty($result['no'])) {
    $nomor = $result['no'];
}

$result_no = $result['no'] ?? '';
$result_nama = $result['nama'] ?? '';
$result_telp = $result['telp'] ?? '';
$result_alamat = $result['alamat'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
</head>
<body style="font-family: Arial; padding: 10px;">
    <h3 style="font-family: Arial;">Edit Data Master Supplier</h3>
    <form action="update.php" method="POST">
        <input type="hidden" name="no" value="<?= htmlspecialchars($nomor) ?>">
        
        <table style="width: 50%;">
            <tr>
                <td style="width: 15%; padding: 5px 0;"><label for="nama"><b>Nama</b></label></td>
                <td style="width: 85%; padding: 5px 0;">
                    <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($result_nama) ?>" 
                               style="padding: 8px; width: 50%; border: 1px solid black; border-radius: 4px; box-sizing: border-box;">
                    <?php if ($error_nama): ?>
                        <div style="color: red; font-size: 14px; margin-top: 5px;"><?php echo $error_nama; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0;"><label for="telp" style="font-weight: bold;">Telp</label></td>
                <td style="padding: 5px 0;">
                    <input type="text" name="telp" id="telp" value="<?= htmlspecialchars($result_telp) ?>" 
                               style="padding: 8px; width: 50%; border: 1px solid black; border-radius: 4px; box-sizing: border-box;">
                    <?php if ($error_telp): ?>
                        <div style="color: red; font-size: 14px; margin-top: 5px;"><?php echo $error_telp; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0;"><label for="alamat" style="font-weight: bold;">Alamat</label></td>
                <td style="padding: 5px 0;">
                    <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($result_alamat) ?>" 
                               style="padding: 8px; width: 50%; border: 1px solid black; border-radius: 4px; box-sizing: border-box;">
                    <?php if ($error_alamat): ?>
                        <div style="color: red; font-size: 0.9em; margin-top: 5px;"><?php echo $error_alamat; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td> 
                <td style="padding-top: 10px;">
                    <button type="submit" 
                    style="background-color: orange; color: white; padding: 8px 20px; border-radius: 3px; cursor: pointer; border: none; font-size: 14px; margin-right: 10px;">
                    <b>Edit</b>
                    </button>
                    
                    <a href="index.php" 
                    style="background-color: red; color: white; padding: 8px 20px; border-radius: 3px; cursor: pointer; border: none; font-size: 14px; text-decoration: none; display: inline-block;">
                    <b>Batal</b>
                    </a>
                </td>
            </tr>
            
        </table>
    </form>
</body>
</html>