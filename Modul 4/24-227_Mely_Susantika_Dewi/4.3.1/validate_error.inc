<?php
$errors = [];

function validateName($field_list, $field_name)
{
    global $errors;

    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name harus diisi.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh huruf.";
        return false;
    }

    return true;
}
?>
