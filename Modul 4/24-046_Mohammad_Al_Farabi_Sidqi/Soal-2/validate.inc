<?php
function validateName($field_list, $field_name, &$error) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name])==='')    {
        $error[$field_name] = "surname tidak boleh kosong.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; // hanya huruf dan tanda '
    if (!preg_match($pattern, $field_list[$field_name])){
        $error[$field_name] = "Hanya boleh berisi huruf (A–Z atau a–z).";
        return false;
    }
    return true;
}

function validateEmail($field_list, $field_email, &$email_err) {
    if (empty($field_list[$field_email])) {
        $email_err = "Email wajib diisi.";
        return false;
    } else {
        $email = $field_list[$field_email];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Format email tidak valid.";
            return false;
        }
    }
    $email_err = '';
    return true;
}

function validatePass($field_list, $field_password, &$password_err) {
    if (empty($field_list[$field_password])) {
        $password_err = "Password wajib diisi.";
        return false;
    } else {
        $password = $field_list[$field_password];
        if (strlen($password) < 8) {
            $password_err = "Password minimal 8 karakter.";
            return false;
        }
    }
    $password_err = '';
    return true;
}
?>