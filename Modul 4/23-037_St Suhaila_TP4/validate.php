<?php
require "validate.inc";

$errors = [];

if (isset($_POST["submit"])) {
    // Panggil fungsi validasi
    validateName($errors, "surname");

    // Jika ada error (array tidak kosong)
    if (!empty($errors)) {
        echo "Data invalid!";
    } else {
        echo "Data OK!";
    }
}
?>
