<?php
// Regular expression
function validateUsername($username) {
    return preg_match("/^[a-zA-Z0-9_]{5,20}$/", $username);
}

// String functions
function formatName($name) {
    return ucfirst(strtolower(trim($name))); // hapus spasi, huruf kecil semua lalu kapital depan
}

// Filter functions
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateURL($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

// Type testing
function isNumericValue($value) {
    return is_numeric($value);
}

// Date validation
function validateDateInput($day, $month, $year) {
    return checkdate($month, $day, $year);
}

// Contoh penggunaan:
$name = " alIFY ";
$email = "test@gmail.com";
$url = "https://example.com";
$day = 30; $month = 2; $year = 2025;

echo "Nama diformat: " . formatName($name) . "<br>";

echo validateEmail($email) ? "Email valid<br>" : "Email invalid<br>";
echo validateURL($url) ? "URL valid<br>" : "URL invalid<br>";
echo isNumericValue("1234") ? "Angka valid<br>" : "Bukan angka<br>";
echo validateDateInput($day, $month, $year) ? "Tanggal valid<br>" : "Tanggal tidak valid<br>";
?>
