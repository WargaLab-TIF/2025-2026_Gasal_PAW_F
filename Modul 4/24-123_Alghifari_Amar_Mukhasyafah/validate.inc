<?php

function validateName($field_list, $field_name, &$errors)
{
    $value = trim($field_list[$field_name] ?? '');

    if ($value === '') {
        $errors[$field_name] = "Field '$field_name' harus diisi.";
        return false;
    }

    $pattern = "/^[a-zA-Z' -]+$/";
    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = "Field '$field_name' hanya boleh berisi huruf.";
        return false;
    }

    return true;
}


function validateEmail($field_list, $field_name, &$errors)
{
    $value = trim($field_list[$field_name] ?? '');
    if ($value === '') {
        $errors[$field_name] = "Field '$field_name' harus diisi.";
        return false;
    }

    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid.";
        return false;
    }

    return true;
}


function validateAge($field_list, $field_name, &$errors)
{
    $value = trim($field_list[$field_name] ?? '');
    if ($value === '') {
        $errors[$field_name] = "Field '$field_name' harus diisi.";
        return false;
    }

    if (!is_numeric($value) || $value <= 0) {
        $errors[$field_name] = "Field '$field_name' harus berupa angka positif.";
        return false;
    }

    return true;
}


function validateDate($field_list, &$errors)
{
    $day = $field_list['day'] ?? '';
    $month = $field_list['month'] ?? '';
    $year = $field_list['year'] ?? '';

    if ($day === '' || $month === '' || $year === '') {
        $errors['date'] = "Semua field tanggal harus diisi.";
        return false;
    }

    if (!checkdate($month, $day, $year)) {
        $errors['date'] = "Tanggal tidak valid.";
        return false;
    }

    return true;
}
?>
