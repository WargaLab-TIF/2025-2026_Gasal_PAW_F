<?php

$error = [];
function validateName($field_list, $field_name){
    global $error;

    if(!isset($field_list[$field_name]) || trim($field_list[$field_name]) === ''){
        $error[] = "Field '$field_name' belum diisi.";
        return false;
    } 

    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)

    if(!preg_match($pattern, $field_list[$field_name])){
        $error[] = "Format nama tidak sesuai";
        return false;
    }
    return true;
}