<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = "Field '$field_name' tidak ditemukan.";
        return false;
    }
    $value = trim($field_list[$field_name]);

    if ($value === '') {
        $errors[$field_name] = "Field '$field_name' tidak boleh kosong.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = "Field '$field_name' hanya boleh berisi huruf, tanda hubung, atau tanda kutip tunggal.";
        return false;
    }
    
    return true;
}
?>
