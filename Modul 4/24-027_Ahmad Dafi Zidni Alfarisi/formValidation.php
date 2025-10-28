<?php
require 'validate.inc';
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $okName  = validateName($_POST, 'nama', $errors);
    $okEmail = validateEmail($_POST, 'email', $errors);
    $okAge   = validateAge($_POST, 'age', $errors);

    if ($okName && $okEmail && $okAge) {
        $success = true;
        $safeSurname = htmlspecialchars(trim($_POST['nama']));
        echo "<p style='color:green;'>Terimakasih sudah mengisi. Surname: {$safeSurname}</p>";
        $_POST = [];
    } else {
        echo "<p style='color:red;'>Ada kesalahan pada form, periksa pesan di bawah.</p>";
    }
}

include 'from.inc';
?>
