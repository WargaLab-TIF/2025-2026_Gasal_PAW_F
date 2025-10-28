<?php
function validateName($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'Nama tidak boleh kosong.';
        return false;
    }
    $value = trim($field_list[$field_name]);
    $pattern = "/^[a-zA-Z' -]+$/"; 
    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = 'Nama hanya boleh berisi huruf, spasi, atau tanda petik.';
        return false;
    }
    return true;
}

function validateEmail($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'Email tidak boleh kosong.';
        return false;
    }
    $email = trim($field_list[$field_name]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'Format email tidak valid.';
        return false;
    }
    return true;
}

function validateAge($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'Umur tidak boleh kosong.';
        return false;
    }
    $age = trim($field_list[$field_name]);
    if (!is_numeric($age) || intval($age) < 0 || intval($age) >
150) { $errors[$field_name] = 'Umur harus angka antara 0 - 100.'; return false;
} return true; } ?>
