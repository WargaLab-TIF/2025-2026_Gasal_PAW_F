<?php
// validate_form.inc
// berisi fungsi validateName dan showError
// validateName menaruh pesan ke array $errors lewat referensi (&$errors)

// pola: hanya huruf A-Z a-z, apostrophe ' dan hyphen -
function validateName(&$errors, $field_list, $field_name)
{
    // pastikan field ada di array input
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = 'required';
        return;
    }

    $value = trim($field_list[$field_name]);

    // cek kosong
    if ($value === '') {
        $errors[$field_name] = 'required';
        return;
    }

    // hanya huruf, apostrophe, dan minus
    $pattern = "/^[a-zA-Z'-]+$/";

    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = 'invalid format';
        return;
    }

    // jika valid -> jangan set apapun (biarkan tidak ada di $errors)
    return;
}

// menampilkan error untuk field tertentu (aman terhadap undefined $errors)
function showError($errors, $field_name)
{
    if (!is_array($errors)) return;
    if (isset($errors[$field_name])) {
        echo '<span class="error">' . htmlspecialchars($errors[$field_name]) . '</span>';
    }
}
?>
