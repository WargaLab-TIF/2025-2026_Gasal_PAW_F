<?php
function validateName($field_list, $field_name)
{
    if (!isset($field_list[$field_name]))
        return false;

    $pattern = "/^[a-zA-Z]+$/";

    if (!preg_match($pattern, $field_list[$field_name]))
        return false;

    return true;
}
?>

<?php
/*
function validateName($field_list, $field_name)
{
    $errors = []; 

    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $errors[] = "Field '$field_name' harus diisi.";
        return $errors;
    }

    $value = trim($field_list[$field_name]);
    $pattern = "/^[a-zA-Z]+$/";

    if (!preg_match($pattern, $value)) {
        $errors[] = "Field '$field_name' hanya boleh berisi huruf (a–z atau A–Z).";
    }

    return $errors;
}
*/
?>



