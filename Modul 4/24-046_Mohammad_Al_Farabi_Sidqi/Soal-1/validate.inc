<?php
function validateName($field_list, $field_name, &$error) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name])==='')    {
        $error[$field_name] = "surname tidak boleh kosong.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; // hanya huruf dan tanda '
    if (!preg_match($pattern, $field_list[$field_name])){
        $error[$field_name] = "$field_list[$field_name] salah, hanya boleh berisi huruf (A–Z atau a–z).";
        return false;
    }
    return true;
}
?>