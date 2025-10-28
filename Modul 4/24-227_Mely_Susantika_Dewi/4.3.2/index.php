<?php
// index.php

// muat file error + fungsi validasi (gunakan require_once untuk mencegah double-include)
require_once 'validate1.inc';
require_once 'validate.inc';

// inisialisasi nilai default agar tidak undefined index
$given_name = '';
$surname = '';

// jika form disubmit -> lakukan validasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil input dan trim
    $given_name = isset($_POST['given_name']) ? trim($_POST['given_name']) : '';
    $surname    = isset($_POST['surname']) ? trim($_POST['surname']) : '';

    // kosongkan array errors sebelum validasi ulang
    $errors = array();

    // panggil fungsi validasi yang menaruh pesan ke $errors lewat referensi
    validateName($errors, $_POST, 'given_name');
    validateName($errors, $_POST, 'surname');

    // jika tidak ada error -> sukses
    if (empty($errors)) {
        echo "<p style='font-weight:bold;'>Form submitted successfully with no errors</p>";
        // berhenti di sini atau redirect jika ingin
        exit;
    } else {
        echo "<p style='color:red; font-weight:bold;'>Invalid, correct the following errors:</p>";
    }
}
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Form Validasi</title>
<style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    div.field { margin-bottom: 10px; }
    label { display: block; font-weight: bold; margin-bottom: 4px; }
    input[type="text"] { padding: 6px; width: 300px; box-sizing: border-box; }
    span.error { color: red; font-size: 0.9em; margin-left: 4px; display: block; }
    input[type="submit"] { padding: 6px 12px; }
</style>
</head>
<body>

<form action="index.php" method="POST" novalidate>
    <div class="field">
        <label for="given_name">Nama Depan:</label>
        <input type="text" id="given_name" name="given_name"
               value="<?php echo htmlspecialchars($given_name ?? ''); ?>">
        <?php showError($errors ?? array(), 'given_name'); ?>
    </div>

    <div class="field">
        <label for="surname">Nama Belakang:</label>
        <input type="text" id="surname" name="surname"
               value="<?php echo htmlspecialchars($surname ?? ''); ?>">
        <?php showError($errors ?? array(), 'surname'); ?>
    </div>

    <input type="submit" value="Submit">
</form>

</body>
</html>
