<?php
function validateSurname($name) {
    // Validasi sederhana: hanya huruf dan panjang minimal 3
    if (preg_match("/^[a-zA-Z]{3,}$/", $name)) {
        return true;
    } else {
        return false;
    }
}
?>
