<?php
function validateSurname($surname) {
    return preg_match("/^[a-zA-Z' ]+$/", trim($surname));
}

function validateEmail($email) {
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    return strlen(trim($password)) >= 6;
}
?>
