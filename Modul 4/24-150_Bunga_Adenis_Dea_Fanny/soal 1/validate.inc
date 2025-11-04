<?php
function validateName($field_list, $field_name, &$errors) 
{ 
    if (!isset($field_list[$field_name])) { 
        return false; 
    }

    $pattern = "/^[a-zA-Z'-]+$/"; 
    
    if (!preg_match($pattern, $field_list[$field_name])) { 
        $errors[$field_name] = "Field '$field_name' hanya boleh berisi huruf, tanda petik tunggal, atau tanda hubung."; 
        return false; 
    }

    return true; 
}
?>

