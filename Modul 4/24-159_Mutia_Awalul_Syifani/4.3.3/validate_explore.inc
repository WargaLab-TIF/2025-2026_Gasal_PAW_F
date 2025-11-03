<?php
// Validasi Surname: Menggunakan Regular expressions (preg_match) dan String (trim, strtolower)
function validateSurname($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name wajib diisi.";
        return false;
    }
    $cleaned = trim(strtolower($field_list[$field_name])); // String: trim dan strtolower untuk normalisasi
    $pattern = "/^[a-z'-]+$/"; // Regular expressions: preg_match untuk pola alfabet
    if (!preg_match($pattern, $cleaned)) {
        $errors[$field_name] = "Field $field_name hanya boleh berisi huruf kecil, apostrof, atau tanda hubung.";
        return false;
    }
    return true;
}

// Validasi Email: Menggunakan Filter (filter_var dengan FILTER_VALIDATE_EMAIL)
function validateEmail($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name wajib diisi.";
        return false;
    }
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) { // Filter: filter_var untuk validasi email
        $errors[$field_name] = "Field $field_name harus dalam format email yang valid.";
        return false;
    }
    return true;
}

// Validasi URL: Menggunakan Filter (filter_var dengan FILTER_VALIDATE_URL)
function validateURL($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name wajib diisi.";
        return false;
    }
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_URL)) { // Filter: filter_var untuk validasi URL
        $errors[$field_name] = "Field $field_name harus dalam format URL yang valid.";
        return false;
    }
    return true;
}

// Validasi Number: Menggunakan Type testing (is_numeric) dan Filter (FILTER_VALIDATE_FLOAT)
function validateNumber($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name wajib diisi.";
        return false;
    }
    if (!is_numeric($field_list[$field_name])) { // Type testing: is_numeric untuk memeriksa angka
        $errors[$field_name] = "Field $field_name harus berupa angka.";
        return false;
    }
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_FLOAT)) { // Filter: filter_var untuk validasi float
        $errors[$field_name] = "Field $field_name harus berupa angka desimal yang valid.";
        return false;
    }
    return true;
}

// Validasi Date: Menggunakan Date (checkdate) dan String (explode untuk parsing)
function validateDate($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name wajib diisi.";
        return false;
    }
    $date = trim($field_list[$field_name]); // String: trim untuk membersihkan
    $parts = explode('-', $date); // String: explode untuk memisahkan YYYY-MM-DD
    if (count($parts) !== 3 || !is_numeric($parts[0]) || !is_numeric($parts[1]) || !is_numeric($parts[2])) {
        $errors[$field_name] = "Field $field_name harus dalam format YYYY-MM-DD.";
        return false;
    }
    $year = (int)$parts[0];
    $month = (int)$parts[1];
    $day = (int)$parts[2];
    if (!checkdate($month, $day, $year)) { // Date: checkdate untuk validasi tanggal
        $errors[$field_name] = "Field $field_name harus berupa tanggal yang valid.";
        return false;
    }
    return true;
}
?>