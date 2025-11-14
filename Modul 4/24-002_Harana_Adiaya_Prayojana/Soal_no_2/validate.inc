<?php
function validateName($field_list, $field_name, &$err){
    if (!isset($field_list[$field_name]) || $field_list[$field_name]===""){
        $err[$field_name]="$field_name Harus di isi";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name])){
        $err[$field_name]="$field_name Invalid!";
        return false;}
    return true;
};
function validateEmail($field_list, $field_name, &$err){
    if (!isset($field_list[$field_name]) || $field_list[$field_name]===""){
        $err[$field_name]="$field_name Harus di isi";
        return false;
    }
    
    $tes_email='/^[a-zA-Z]+@[a-zA-Z]+\.[a-zA-z]{2,}$/';
    if (!preg_match($tes_email, $field_list[$field_name])){
        $err[$field_name]="$field_name Invalid!";
        return false;}
    return true;
}
?>