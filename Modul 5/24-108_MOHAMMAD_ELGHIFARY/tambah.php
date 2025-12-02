<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "store";
$koneksi = mysqli_connect($servername, $username, $password, $db);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
function validateName($field_list, $field_name) {
    $field = trim($field_list[$field_name] ?? '');
    $pattern = "/^[a-zA-Z]+$/"; 
    $detailerr = ['kondisi' => true, 'eror' => ''];
    if (empty($field)) {
        $detailerr['eror'] = 'nama tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!preg_match($pattern, $field)) { 
        $detailerr['eror'] = 'nama hanya boleh berisi huruf.';
        $detailerr['kondisi'] = false;
    }

    $field = strtoupper($field); 
    return $detailerr;
}
function validateTelp($field_list, $field_name) {
    $detailerr = ['kondisi' => true, 'eror' => ''];
    $field = trim($field_list[$field_name] ?? '');
    $pattern = "/^[0-9]+$/"; 
    if ($field === '') {
        $detailerr['eror'] = 'Input telp tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!preg_match($pattern, $field)) { 
        $detailerr['eror'] = 'Input hanya boleh berisi angka (0-9).';
        $detailerr['kondisi'] = false;
    }

    return $detailerr;
}
function validateAlamat($field_list, $field_name) {
    $detailerr = ['kondisi' => true, 'eror' => ''];
    $field = trim($field_list[$field_name] ?? '');
    if (empty($field)) {
        $detailerr['eror'] = 'Input alamat tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $field)) {
        $detailerr['eror'] = 'Input hanya boleh berisi huruf dan angka.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }   
    if (!preg_match('/[a-zA-Z]/', $field)) {
        $detailerr['eror'] = 'Input harus mengandung setidaknya satu huruf.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!preg_match('/[0-9]/', $field)) {
        $detailerr['eror'] = 'Input harus mengandung setidaknya satu angka.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    return $detailerr;
}
function validateRequired($field_list, $field_name) {
    $field = $field_list[$field_name] ?? null;
    $detailerr = ['kondisi' => true, 'eror' => ''];

    if (empty($field)) {
        $detailerr['eror'] = $field_name . ' tidak boleh kosong.';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}

$nama = "";
$telp = "";
$alamat = "";
$data=['nama','telp','alamat'];
$errors=[];
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'] ?? "";
    $telp = $_POST['telp'] ?? "";
    $alamat = $_POST['alamat'] ?? "";
    $terisiPenuh=True;
    $validName = validateName($_POST, 'nama');
    $sukses = True;
    if(!$validName['kondisi']){
        $errors['nama'] = $validName['eror'];
        $sukses = false;
    }
    $validTelp = validateTelp($_POST, 'telp');
    if(!$validTelp['kondisi']){
        $errors['telp'] = $validTelp['eror'];
        $sukses = false;
    }
    $validAlamat = validateAlamat($_POST, 'alamat');
    if(!$validAlamat['kondisi']){
        $errors['alamat'] = $validAlamat['eror'];
        $sukses = false;
    }
    if($sukses){
        $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        if (mysqli_query($koneksi, $sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($koneksi);
        }
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            width: 100px;
            font-weight: bold;
        }
        .form-group input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            max-width: 200px;
        }
        .button-container {
            margin-left: 100px;
        }
        .simpan {
            background-color: green;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .simpan:hover {
            background-color: darkgreen;
        }
        .batal {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .batal:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<h2>Tambah Supplier</h2>

<form action="tambah.php" method="post">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" placeholder="Nama" value="<?= htmlspecialchars($nama) ?>">
        <?php if (!empty($errors['nama'])): ?>
            <span style="color:red; margin-left: 10px;"><?= $errors['nama'] ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="telp">Telp</label>
        <input type="text" name="telp" id="telp" placeholder="Telp" value="<?= htmlspecialchars($telp) ?>">
        <?php if (!empty($errors['telp'])): ?>
            <span style="color:red; margin-left: 10px;"><?= $errors['telp'] ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?= htmlspecialchars($alamat) ?>">
        <?php if (!empty($errors['alamat'])): ?>
            <span style="color:red; margin-left: 10px;"><?= $errors['alamat'] ?></span>
        <?php endif; ?>
    </div>

    <div class="button-container">
        <button type="submit" name="submit" class="simpan">Simpan</button>
        <a href="index.php"><button type="button" class="batal">Batal</button></a>
    </div>
</form>

</body>
</html>
