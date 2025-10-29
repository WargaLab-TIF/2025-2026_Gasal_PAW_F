<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!is_array($errors)) $errors = [];

    if (!isset($field_list[$field_name]) || trim((string)$field_list[$field_name]) === '') {
        $errors[$field_name] = ucfirst($field_name) . " tidak boleh kosong!";
        return false;
    }

    $pattern = "/^[a-zA-Z\s'-]+$/u";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = ucfirst($field_name) . " hanya boleh berisi huruf, spasi, tanda petik (') dan tanda hubung (-)!";
        return false;
    }

    return true;
}

function validateEmail($email, &$errors) {
    if (!isset($email) || trim((string)$email) === '') {
        $errors['email'] = "Email tidak boleh kosong!";
        return false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email tidak valid!";
        return false;
    }
    return true;
}

function validatePassword($password, &$errors) {
    if (!isset($password) || $password === '') {
        $errors['password'] = "Password tidak boleh kosong!";
        return false;
    }
    if (strlen($password) < 6) {
        $errors['password'] = "Password minimal 6 karakter!";
        return false;
    }
    return true;
}
?>
