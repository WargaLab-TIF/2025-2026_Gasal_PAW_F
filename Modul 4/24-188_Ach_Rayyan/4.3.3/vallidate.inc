<?php
function validateName($field_list, $field_name, &$errors)
{
    if (!isset($field_list[$field_name]) || trim((string)$field_list[$field_name]) === '') {
        $errors[$field_name] = ucfirst($field_name) . " harus diisi!";
        return false;
    }

    $pattern = "/^[a-zA-Z\s'-]+$/u";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = ucfirst($field_name) . " hanya boleh huruf, spasi, tanda petik (') dan tanda hubung (-)!";
        return false;
    }

    return true;
}

function validateEmail($email, &$errors) {
    if (trim($email) === '') {
        $errors['email'] = "Email harus diisi!";
        return false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email tidak valid!";
        return false;
    }
    return true;
}

function validatePassword($password, &$errors) {
    if (trim($password) === '') {
        $errors['password'] = "Password harus diisi!";
        return false;
    }
    if (strlen($password) < 6) {
        $errors['password'] = "Password minimal 6 karakter!";
        return false;
    }
    if (!is_numeric($password)) {
        $errors['password'] = "Password harus berupa angka!";
        return false;
    }
    return true;
}

function validateDate($day, $month, $year, &$errors) {
    if (trim($day) === '' || trim($month) === '' || trim($year) === '') {
        $errors['birth_date'] = "Tanggal lahir harus diisi!";
        return false;
    }

    // pastikan integer, lalu validasi dengan checkdate()
    $d = (int)$day;
    $m = (int)$month;
    $y = (int)$year;

    if (!checkdate($m, $d, $y)) {
        $errors['birth_date'] = "Tanggal lahir tidak valid!";
        return false;
    }

    return true;
}
?>
