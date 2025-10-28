<?php
function validateName($field_list, $field_name, &$error) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $error[$field_name] = "kolom $field_name harus diisi.";
        return false;
    }
    $pattern = "/^[a-zA-Z'-]+$/"; // hanya huruf dan tanda '
    if (!preg_match($pattern, $field_list[$field_name])){
        $error[$field_name] = "kolom $field_name hanya boleh berisi huruf.";
        return false;
    }
    return true;
}
?>
