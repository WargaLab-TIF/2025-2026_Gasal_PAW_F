<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name tidak boleh kosong.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh berisi huruf alfabet.";
        return false;
    }

    return true;
}

function validateEmail($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name tidak boleh kosong.";
        return false;
    }

    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid.";
        return false;
    }

    return true;
}
?>