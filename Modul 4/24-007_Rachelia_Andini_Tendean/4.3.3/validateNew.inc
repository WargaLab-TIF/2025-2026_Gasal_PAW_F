<?php

// Regular Expression + String
function validatePhone($field_list, $field_name, &$errors) {
    if (!empty($field_list[$field_name])) {
        $value = trim($field_list[$field_name]); // string trim()
        if (!preg_match("/^[0-9]{10,15}$/", $value)) {  // REGEX
            $errors[$field_name] = "Nomor telepon harus 10–15 digit angka";
        }
    }
}

// String + Filter (email)
function validateEmail($field_list, $field_name, &$errors) {
    if (!empty($field_list[$field_name])) {
        $value = strtolower(trim($field_list[$field_name])); // string trim + strtolower
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {    // FILTER
            $errors[$field_name] = "Format email tidak valid";
        }
    }
}

// URL + String
function validateURL($field_list, $field_name, &$errors) {
    if (!empty($field_list[$field_name])) {
        $value = trim(strtolower($field_list[$field_name]));
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $errors[$field_name] = "Format URL tidak valid";
        }
    }
}

// Type Testing (is_numeric)
function validateNumber($field_list, $field_name, &$errors) {
    if (!empty($field_list[$field_name]) && !is_numeric($field_list[$field_name])) {
        $errors[$field_name] = ucfirst($field_name) . " harus berupa angka";
    }
}

// Date Check
function validateDateField($field_list, $field_name, &$errors) {
    if (!empty($field_list[$field_name])) {
        $date = explode('-', $field_list[$field_name]);
        if (count($date) !== 3 || !checkdate($date[1], $date[2], $date[0])) {
            $errors[$field_name] = "Tanggal tidak valid (format: YYYY-MM-DD)";
        }
    }
}
?>
