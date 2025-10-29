<?php

$error = [];
function validateName($field_list, $field_name){
    global $error;

    if(!isset($field_list[$field_name]) || trim($field_list[$field_name]) === ''){
        $error[] = "Form Kosong";
        return false;
    } 

    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)

    if(!preg_match($pattern, $field_list[$field_name])){
        $error[] = "Format nama tidak sesuai";
        return false;
    }
    return true;
}

function validateEmail($field_list, $field_name){
    global $error;

    if(!isset($field_list[$field_name]) || trim($field_list[$field_name]) === ''){
        $error[] = "Email belum diisi";
        return false;
    }

    if(!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)){
        $error[] = "Format email tidak valid";
        return false;
    }

    return true;
}
