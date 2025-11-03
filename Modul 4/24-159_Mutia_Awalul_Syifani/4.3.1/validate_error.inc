<?php
function validateName($field_list, $field_name, &$errors)
{

    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name wajib diisi.";
        return false;
    }

    $pattern = "/^[A-Za-z]+$/";

    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh berisi huruf saja";
        return false;
    }

    return true;
}
?>
