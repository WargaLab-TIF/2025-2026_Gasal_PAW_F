<?php
function validateName($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'nama tidak boleh kosong';
        return false;
    }

    // Regular Expression
    $pattern = "/^[a-zA-Z' -]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'nama hanya boleh mengandung huruf alfabet';
        return false;
    }

    return true;
}

function validateEmail($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'email tidak boleh kosong';
        return false;
    }

    // Filter
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'format email tidak valid';
        return false;
    }

    return true;
}

function validateAge($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'umur tidak boleh kosong';
        return false;
    }

    // Type testing
    if (!is_numeric($field_list[$field_name]) || $field_list[$field_name] <= 0) {
        $errors[$field_name] = 'format umur tidak valid';
        return false;
    }

    return true;
}

function validateBirthdate($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'tanggal lahir tidak boleh kosong';
        return false;
    }

    // Date validation
    $parts = explode('-', $field_list[$field_name]);
    if (count($parts) != 3 || !checkdate($parts[1], $parts[2], $parts[0])) {
        $errors[$field_name] = 'format tanggal lahir tidak valid';
        return false;
    }

    return true;
}
?>