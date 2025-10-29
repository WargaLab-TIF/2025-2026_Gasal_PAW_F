<?php
    function validateName($field_list, $field_name, &$errors)
    {
        // Pastikan array $errors sudah ada
        if (!is_array($errors)) {
            $errors = [];
        }

        // Cek apakah field ada di form
        if (!isset($field_list[$field_name]) or empty(trim($field_list[$field_name]))) {
            $errors[$field_name] = "Nama tidak boleh kosong!";
            return false;
        }

        // Pola hanya huruf, tanda petik tunggal, dan tanda hubung
        $pattern = "/^[a-zA-Z'-]+$/";

        if (!preg_match($pattern, $field_list[$field_name])) {
            $errors[$field_name] = "Nama hanya boleh berisi huruf, tanda petik ('), dan tanda hubung (-)!";
            return false;
        }

        // Jika semua validasi lolos
        return true;
    }
?>