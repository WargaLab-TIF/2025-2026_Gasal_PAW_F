<?php
function validateName($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'nama tidak boleh kosong';
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
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

    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
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

    $pattern = "/^[0-9]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'format umur tidak valid';
        return false;
    }

    return true;
}
?>