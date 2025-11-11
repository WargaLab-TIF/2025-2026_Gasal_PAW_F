<?php
// validate.php

// Validasi untuk Form Tambah Barang
function validateNamaBarang($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Nama barang tidak boleh kosong!";
        return false;
    }
    if (strlen(trim($field_list[$field_name])) < 3) {
        $errors[$field_name] = "Nama barang minimal 3 karakter!";
        return false;
    }
    return true;
}

function validateHarga($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Harga satuan tidak boleh kosong!";
        return false;
    }
    if (!is_numeric($field_list[$field_name])) {
        $errors[$field_name] = "Harga satuan harus berupa angka!";
        return false;
    }
    if ((int)$field_list[$field_name] <= 0) {
        $errors[$field_name] = "Harga satuan harus lebih dari 0!";
        return false;
    }
    return true;
}

// Validasi untuk Form Tambah Transaksi
function validateWaktu($field_list, $field_name, &$errors)
{
    $today = date('Y-m-d');
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Waktu transaksi tidak boleh kosong.";
        return false;
    }
    if ($field_list[$field_name] < $today) {
        $errors[$field_name] = "Tanggal transaksi tidak boleh kurang dari hari ini.";
        return false;
    }
    return true;
}

function validateKeterangan($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Keterangan tidak boleh kosong.";
        return false;
    }
    if (strlen(trim($field_list[$field_name])) < 3) {
        $errors[$field_name] = "Keterangan minimal 3 karakter.";
        return false;
    }
    return true;
}

function validateDropdown($field_list, $field_name, $message, &$errors)
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = $message;
        return false;
    }
    return true;
}

// Validasi untuk Form Tambah Detail
function validateQty($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Quantity tidak boleh kosong.";
        return false;
    }
    if (!is_numeric($field_list[$field_name]) || (int)$field_list[$field_name] <= 0) {
        $errors[$field_name] = "Quantity harus angka dan lebih dari 0.";
        return false;
    }
    return true;
}
