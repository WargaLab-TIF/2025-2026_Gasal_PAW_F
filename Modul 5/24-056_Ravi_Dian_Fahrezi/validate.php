<?php
    function validateName($field_list, $field_name, &$errors)
    {
        if (!is_array($errors)) {
            $errors = [];
        }

        if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
            $errors[$field_name] = "Nama tidak boleh kosong!";
            return false;
        }

        // Type testing: pastikan input bertipe string
        if (!is_string($field_list[$field_name])) {
            $errors[$field_name] = "Input nama harus berupa teks!";
            return false;
        }

        // Regular Expression: hanya huruf, dan spasi
        $pattern = "/^[a-zA-Z\s]+$/";

        if (!preg_match($pattern, $field_list[$field_name])) {
            $errors[$field_name] = "Nama hanya boleh berisi huruf, dan spasi!";
            return false;
        }

        return true;
    }

    function validateAlamat($field_list, $field_name, &$errors)
    {
        if (!is_array($errors)) {
            $errors = [];
        }

        // Cek apakah kosong
        if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
            $errors[$field_name] = "Alamat tidak boleh kosong!";
            return false;
        }

        // Pastikan input bertipe string
        if (!is_string($field_list[$field_name])) {
            $errors[$field_name] = "Input alamat harus berupa teks!";
            return false;
        }

        // Regex: huruf, angka, spasi, titik, koma, dan tanda hubung diperbolehkan
        $pattern = "/^[a-zA-Z0-9\s.,-]+$/";

        if (!preg_match($pattern, $field_list[$field_name])) {
            $errors[$field_name] = "Alamat hanya boleh berisi huruf, angka, spasi, titik, koma, dan tanda hubung!";
            return false;
        }

        return true;
    }

    function validateTelepon($field_list, $field_name, &$errors)
    {
        if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
            $errors[$field_name] = "Nomor telepon tidak boleh kosong!";
            return false;
        }

        $telepon = trim($field_list[$field_name]);

        // Hanya angka, boleh diawali tanda +, minimal 10 digit, maksimal 13 digit
        $pattern = "/^[0-9]{10,13}$/";

        if (!preg_match($pattern, $telepon)) {
            $errors[$field_name] = "Nomor telepon harus berupa angka dan panjang 10-13 digit!";
            return false;
        }

        return true;
    }
?>