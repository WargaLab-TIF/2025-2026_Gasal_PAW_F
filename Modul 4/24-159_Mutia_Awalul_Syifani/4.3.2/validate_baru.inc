<?php
function validateName($field_list, $field_name) 
{ 
    if (!isset($field_list[$field_name])) 
        return false; 
    $pattern = "/^[a-zA-Z'-]+$/";   
    if (!preg_match($pattern, $field_list[$field_name])) 
        return false; 
    return true; 
}

function validateEmail($field_list, $field_name) 
{ 
    if (!isset($field_list[$field_name])) 
        return false; 
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";   
    if (!preg_match($pattern, $field_list[$field_name])) 
        return false; 
    return true; 
}
?>
