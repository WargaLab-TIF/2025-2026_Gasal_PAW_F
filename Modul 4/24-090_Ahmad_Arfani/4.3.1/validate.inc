<?php
// langkah 1
// function validateName($field_list, $field_name) {
//     if (!isset($field_list[$field_name]))
//         return false;

//     $pattern = "/^[a-zA-Z'-]+$/"; 
//     if (!preg_match($pattern, $field_list[$field_name]))
//         return false;    

//     return true;
// }

// langkah 4
function validateName($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'field tidak boleh kosong';
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'nama hanya boleh mengandung huruf alfabet';
        return false;
    }

    return true;
}
?>
