<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'Surname tidak boleh kosong.';
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Surname hanya boleh berisi alfabet, tanda petik, atau strip.';
        return false;
    }
    
    return true;
}

function validateEmail($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'Email tidak boleh kosong.';
        return false;
    }

    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'Format email tidak valid.';
        return false;
    }
    return true;
}

function validateUsername($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'Username tidak boleh kosong.';
        return false;
    }

    $pattern = "/^[a-zA-Z0-9_]{5,15}$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Username harus 5-15 karakter (hanya boleh huruf, angka, dan underscore).';
        return false;
    }
    return true;
}
?>
