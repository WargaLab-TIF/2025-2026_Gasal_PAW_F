<?php

function validateName($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = strtoupper(trim($field_list[$field_name])); 

    if (!is_string($value)) {
        $error[$field_name] = "Field $field_name harus berupa teks (string)";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $value)) {
        $error[$field_name] = "Field $field_name hanya boleh berisi huruf, tanda petik, dan tanda hubung";
        return false;
    }

    return true;
}

function validateAge($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = $field_list[$field_name];

    if (!is_numeric($value) || $value <= 0) {
        $error[$field_name] = "Field $field_name harus berupa angka positif";
        return false;
    }

    if (!is_int($value + 0)) {
        $error[$field_name] = "Field $field_name harus berupa bilangan bulat (integer)";
        return false;
    }

    return true;
}

function validateEmail($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = strtolower(trim($field_list[$field_name])); 
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $error[$field_name] = "Field $field_name harus berupa alamat email yang valid";
        return false;
    }
    
    return true;
}

function validatePhone($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = trim($field_list[$field_name]);
    $pattern = "/^[0-9]{10,13}$/"; 
    if (!preg_match($pattern, $value)) {
        $error[$field_name] = "Field $field_name harus berisi 10–13 digit angka";
        return false;
    }

    return true;
}

function validateURL($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = trim($field_list[$field_name]);
    if (!filter_var($value, FILTER_VALIDATE_URL)) {
        $error[$field_name] = "Field $field_name harus berupa URL yang valid (contoh: https://www.google.com)";
        return false;
    }

    return true;
}

function validateIP($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = trim($field_list[$field_name]);
    if (!filter_var($value, FILTER_VALIDATE_IP)) {
        $error[$field_name] = "Field $field_name harus berupa alamat IP yang valid";
        return false;
    }
    return true;
}

function validateFloat($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = trim($field_list[$field_name]);

    if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
        $error[$field_name] = "Field $field_name harus berupa angka desimal (float)";
        return false;
    }

    if (!is_float($value + 0)) {
        $error[$field_name] = "Field $field_name harus bertipe float";
        return false;
    }

    return true;
}

function validateDate($field_list, $field_name, &$error)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $error[$field_name] = "Field $field_name tidak boleh kosong";
        return false;
    }

    $value = trim($field_list[$field_name]);

    if (!preg_match("/^\d{2}-\d{2}-\d{4}$/", $value)) {
        $error[$field_name] = "Format tanggal harus DD-MM-YYYY (contoh: 12-12-2001)";
        return false;
    }

    $parts = explode('-', $value);
    [$day, $month, $year] = $parts;

    if (!checkdate((int)$month, (int)$day, (int)$year)) {
        $error[$field_name] = "Tanggal tidak valid";
        return false;
    }

    return true;
}