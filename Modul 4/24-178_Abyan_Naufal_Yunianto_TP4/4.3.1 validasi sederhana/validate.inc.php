<?php
    function validateName($field_list,$field_name){
        $error = array();
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
?>