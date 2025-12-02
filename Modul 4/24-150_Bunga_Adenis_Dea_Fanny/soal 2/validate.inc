<?php
function validateName($field_list, $field_name, &$errors) {
    $value = trim($field_list[$field_name] ?? '');
    if ($value === '') {
        $errors[$field_name] = "Field '$field_name' tidak boleh kosong.";
        return false;
    }
    if (!preg_match("/^[a-zA-Z'-]+$/", $value)) {
        $errors[$field_name] = "Field '$field_name' hanya boleh berisi huruf, tanda petik tunggal, atau tanda hubung.";
        return false;
    }
    return true;
}

function validateEmail($field_list, $field_name, &$errors) {
    $value = trim($field_list[$field_name] ?? '');
    if ($value === '') {
        $errors[$field_name] = "Field '$field_name' tidak boleh kosong.";
        return false;
    }
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid.";
        return false;
    }
    return true;
}

function validatePassword($field_list, $field_name, &$errors) {
    $value = trim($field_list[$field_name] ?? '');
    if ($value === '') {
        $errors[$field_name] = "Password tidak boleh kosong.";
        return false;
    }
    if (strlen($value) < 6) {
        $errors[$field_name] = "Password minimal 6 karakter.";
        return false;
    }
    return true;
}

function validateStreet($field_list, $field_name, &$errors) {
    $value = trim($field_list[$field_name] ?? '');
    if ($value === '') {
        $errors[$field_name] = "Field '$field_name' tidak boleh kosong.";
        return false;
    }
    return true;
}

function validateState($field_list, $field_name, &$errors) {
    $value = trim($field_list[$field_name] ?? '');
    if ($value === '') {
        $errors[$field_name] = "Silakan pilih salah satu state.";
        return false;
    }
    return true;
}

function validateGender($field_list, $field_name, &$errors) {
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Pilih salah satu gender.";
        return false;
    }
    return true;
}

function validateHobi($field_list, $field_name, &$errors) {
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Pilih minimal satu hobi.";
        return false;
    }
    return true;
}
?>
