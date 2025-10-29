<?php
function validateAlphabet($input) {
    if (preg_match("/^[a-zA-Z]+$/", $input)) {
        return "Input valid.";
    } else {
        return "Input harus berisi alfabet saja.";
    }
}

function cleanstandarstr($input) {
    $cleaned = trim($input);
    $lower = strtolower($cleaned);
    $upper = strtoupper($cleaned);
    return "Trimmed: " . $cleaned . " <br> Lower: " . $lower . " <br> Upper: " . $upper;
}

function validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Format email valid.";
    } else {
        return "Format email tidak valid.";
    }
}

function validateURL($url) {
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return "URL valid.";
    } else {
        return "URL tidak valid.";
    }
}

function validatefloat($float) {
    if (filter_var($float, FILTER_VALIDATE_FLOAT)) {
        return "Float valid.";
    } else {
        return "Float tidak valid.";
    }
}

function validateIPAddress($ip) {
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        return "Alamat IP valid.";
    } else {
        return "Alamat IP tidak valid.";
    }
}

function checkType($input) {
    if (is_int($input)) {
        return "Tipe data: Integer";
    } elseif (is_float($input)) {
        return "Tipe data: Float";
    } elseif (is_numeric($input)) {
        return "Tipe data: Numerik";
    } elseif (is_string($input)) {
        return "Tipe data: String";
    } else {
        return "Tipe data: Tidak Dikenali";
    }
}

function validateDate($day, $month, $year) {
    if (checkdate($month, $day, $year)) {
        return "Tanggal valid.";
    } else {
        return "Tanggal tidak valid.";
    }
}

// Input untuk diuji
$inputAlphabet = "Hello";
$inputString = "   Input Dengan Spasi   ";
$inputEmail = "dewi56@gmail.com";
$inputURL = "https://YouTube.com";
$inputFloat = 155.5;
$inputIP = "192.168.1.1";
$inputNumber = 100;
$inputstrnum = "123";
$inputstr = "aiueo";
$inputdate = [29, 10, 2025];

$day = $inputdate[0];
$month = $inputdate[1];
$year  = $inputdate[2];

// Menampilkan hasil validasi
echo "<h4>1. Regular Expressions (preg_match)</h4>";
echo "Alphabet Validasi: {$inputAlphabet} | " . validateAlphabet($inputAlphabet) . "<br>";

echo "<h4>2. String (trim, strtolower, strtoupper)</h4>";
echo "Input: ' {$inputString} ' <br> " . cleanstandarstr($inputString) . "<br>";

echo "<h4>3. Filter</h4>";
echo "Email Validasi: " . validateEmail($inputEmail) . "<br>";
echo "URL Validasi: " . validateURL($inputURL) . "<br>";
echo "Float Validasi: " . validatefloat($inputFloat) . "<br>";
echo "IP Address Validasi: " . validateIPAddress($inputIP) . "<br>";

echo "<h4>4. Type Testing (is_float, is_int, is_numeric, is_string)</h4>";
echo "Input: {$inputNumber} (int) | " . checkType($inputNumber) . "<br>";
echo "Input: {$inputFloat} | " . checkType(3.14) . "<br>";
echo "Input: '{$inputstrnum}' (string numerik) |" . checkType("123") . "<br>";
echo "Input: '{$inputstr}' (string) | " . checkType("abc") . "<br>";

echo "<h4>5. Date (checkdate)</h4>";
echo "Validasi Tanggal: {$day}-{$month}-{$year} | " . validateDate($day, $month, $year) . "<br>";