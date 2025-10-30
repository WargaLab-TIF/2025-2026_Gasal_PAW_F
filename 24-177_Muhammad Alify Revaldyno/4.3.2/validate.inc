<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak ditemukan.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; // hanya huruf, tanda ' dan -
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh berisi huruf alfabet.";
        return false;
    }

    return true;
}
?>
