<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!is_array($errors)) {
        $errors = [];
    }

    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Nama tidak boleh kosong!";
        return false;
    }

    // Type testing: pastikan input bertipe string
    if (!is_string($field_list[$field_name])) {
        $errors[$field_name] = "Input nama harus berupa teks!";
        return false;
    }

    // Regular Expression: hanya huruf, petik, dan tanda hubung
    $pattern = "/^[a-zA-Z'-]+$/";

    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Nama hanya boleh berisi huruf, tanda petik ('), dan tanda hubung (-)!";
        return false;
    }

    return true;
}

function validateEmail($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Email tidak boleh kosong!";
        return false;
    }

    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid!";
        return false;
    }

    return true;
}

function validatePassword($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Password tidak boleh kosong!";
        return false;
    }

    if (is_numeric($field_list[$field_name])) {
        $errors[$field_name] = "Password tidak boleh hanya berupa angka!";
        return false;
    }

    if (strlen($field_list[$field_name]) < 6) {
        $errors[$field_name] = "Password minimal 6 karakter!";
        return false;
    }

    return true;
}

function validateBirthdate($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Tanggal lahir tidak boleh kosong!";
        return false;
    }

    // Pisahkan tanggal lahir menjadi tahun, bulan, hari
    $dateParts = explode('-', $field_list[$field_name]);
    if (count($dateParts) !== 3 || !checkdate($dateParts[1], $dateParts[2], $dateParts[0])) {
        $errors[$field_name] = "Tanggal lahir tidak valid!";
        return false;
    }

    return true;
}
?>