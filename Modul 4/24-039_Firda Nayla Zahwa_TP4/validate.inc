<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $errors[$field_name] = "Field $field_name tidak boleh kosong.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; // hanya huruf
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak valid (hanya boleh berisi huruf).";
        return false;
    }

    return true;
}
?>
