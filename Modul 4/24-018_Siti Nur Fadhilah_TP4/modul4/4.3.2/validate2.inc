<?php
//
function validateName(&$errors, $field_list, $field_name)
{
$pattern = "/^[a-zA-Z'-]+$/";

//
if (!isset($field_list[$field_name]) ||
empty($field_list[$field_name]))
//
$errors[$field_name] = 'required';
//
else if (!preg_match($pattern, $field_list[$field_name]))
//
$errors[$field_name] = 'invalid format'; //
}
function showError(&$errors, $field_name)
{
if (isset($errors[$field_name])) {
//
echo '<span style="color: red; font-size: 0.9em;">' . $errors[$field_name] . '</span>';
}
}
?>