<?php
function validateName($fields, $field_name, &$errors) {
    if (empty($fields[$field_name])) {
        $errors[$field_name] = "Nama harus diisi.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fields[$field_name])) {
        $errors[$field_name] = "Nama hanya boleh berisi huruf dan spasi.";
    }
}

function validateTelepon($fields, $field_name, &$errors) {
    if (empty($fields[$field_name])) {
        $errors[$field_name] = "Nomor telepon harus diisi.";
    } elseif (!preg_match("/^[0-9]+$/", $fields[$field_name])) {
        $errors[$field_name] = "Nomor telepon hanya boleh angka.";
    }
}

function validateAlamat($fields, $field_name, &$errors) {
    if (empty($fields[$field_name])) {
        $errors[$field_name] = "Alamat harus diisi.";
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$/", $fields[$field_name])) {
        $errors[$field_name] = "Alamat harus mengandung huruf dan angka.";
    }
}
?>
