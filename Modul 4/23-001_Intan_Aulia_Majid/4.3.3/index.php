<?php
// ======= FILE: index.php =======
require 'validate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = []; // reset array error

    // Jalankan semua validasi
    validateNameRegex($_POST, 'surname');
    validateEmailFilter($_POST, 'email');
    validateURL($_POST, 'website');
    validateInteger($_POST, 'age');
    validateISODateString($_POST, 'birthdate');
    validateIP($_POST, 'ip');

    // Hasil
    if (empty($errors)) {
        echo "<h3>Semua validasi berhasil!</h3>";
    } else {
        echo "<h3>Terdapat kesalahan:</h3>";
        echo "<ul>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Form Validasi PHP Server-Side</h2>
    <?php include "form.php"; ?>
</body>
</html>
