<?php
function validateName($field_list, $field_name, &$errors) {
    if (!empty($field_list[$field_name]) && !preg_match("/^[a-zA-Z' -]+$/", $field_list[$field_name])) {
        $errors[$field_name] = ucfirst($field_name) . " hanya boleh huruf alfabet";
    }
}

function validateNIM($field_list, $field_name, &$errors) {
    if (!empty($field_list[$field_name])) {
        $nim = $field_list[$field_name];

        // Cek apakah 12 digit
        if (!preg_match("/^[0-9]{12}$/", $nim)) {
            $errors[$field_name] = ucfirst($field_name) . " harus berupa angka (12 digit)";
        }
    }
}


?>
