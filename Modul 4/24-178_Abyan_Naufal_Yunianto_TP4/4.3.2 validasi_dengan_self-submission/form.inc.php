<?php
    function validateName($field_list,$field_name){
        $error = [];
        if (!isset($field_list[$field_name]) || $field_list[$field_name] === '') {
            $error[] = "Field $field_name wajib diisi.";
        } else {
            $pattern = "/^[a-zA-Z]+$/"; //format nama(alphabet)
            if (!preg_match($pattern,$field_list[$field_name])) {
                $error[] = "Field $field_name hanya boleh berisi huruf alphabet.";
            }
        }
        return $error;
    }

    function validateEmail($field_list,$field_name){
        $error = [];
        if (!isset($field_list[$field_name]) || $field_list[$field_name] === '') {
            $error[] = "Field $field_name wajib diisi.";
        } elseif(!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)){
            $error[] = "Field $field_name harus berisi alamat email.";
        }
        return $error;
    }
?>