<?php
function validateName($field_list, $field_name, $errors = [])
{
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = "Field '$field_name' harus diisi.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; // hanya huruf dan tanda petik
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field '$field_name' hanya boleh berisi huruf (A-Z atau a-z).";
        return false;
    }

    return true;
}
?>
