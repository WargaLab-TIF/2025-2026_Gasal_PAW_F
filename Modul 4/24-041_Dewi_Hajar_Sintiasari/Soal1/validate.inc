<?php

/*
function validateName($field_list, $field_name)
{
    if (!isset($field_list[$field_name]))
        return false;
    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name]))
        return false;
    return true;
} 
*/

function validateName($field_list, $field_name, &$errors) 
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name tidak boleh kosong.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; 
    
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name harus berupa alfabet.";
        return false;
    }

    return true;
}

?>