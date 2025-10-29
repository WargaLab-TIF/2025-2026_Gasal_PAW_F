<?php
// ======= FILE: validate.php =======
$errors = [];

/* -------------------------------
   1. Regular Expressions
--------------------------------*/
function validateNameRegex(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "Field '$field' belum diisi.";
        return false;
    }
    $pattern = "/^[a-zA-Z'\-\s]+$/";
    if (!preg_match($pattern, $data[$field])) {
        $errors[] = "Format '$field' tidak sesuai (hanya huruf, spasi, - atau ').";
        return false;
    }
    return true;
}

/* -------------------------------
   2. String Functions
--------------------------------*/
function normalizeAndCheck(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field])) {
        $errors[] = "Field '$field' tidak ditemukan.";
        return false;
    }

    $value = trim($data[$field]);
    $lower = strtolower($value);
    $upper = strtoupper($value);

    if ($lower === '') {
        $errors[] = "Field '$field' kosong setelah trimming.";
        return false;
    }

    // contoh penggunaan strtolower/strtoupper
    $data[$field.'_lower'] = $lower;
    $data[$field.'_upper'] = $upper;

    return true;
}

/* -------------------------------
   3. Filter Functions
--------------------------------*/
function validateEmailFilter(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "Email belum diisi.";
        return false;
    }
    if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
        return false;
    }
    return true;
}

function validateURL(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "URL belum diisi.";
        return false;
    }
    if (!filter_var($data[$field], FILTER_VALIDATE_URL)) {
        $errors[] = "Format URL tidak valid.";
        return false;
    }
    return true;
}

function validateFloatFilter(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "Nilai numeric belum diisi.";
        return false;
    }
    if (!filter_var($data[$field], FILTER_VALIDATE_FLOAT) && !is_numeric($data[$field])) {
        $errors[] = "Bukan angka (float) yang valid.";
        return false;
    }
    return true;
}

function validateIP(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "IP belum diisi.";
        return false;
    }
    if (!filter_var($data[$field], FILTER_VALIDATE_IP)) {
        $errors[] = "Format IP tidak valid.";
        return false;
    }
    return true;
}

/* -------------------------------
   4. Type Testing
--------------------------------*/
function validateInteger(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "Field '$field' belum diisi.";
        return false;
    }
    if (!ctype_digit($data[$field])) {
        $errors[] = "Field '$field' harus berupa integer positif.";
        return false;
    }
    return true;
}

function validateNumeric(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "Field '$field' belum diisi.";
        return false;
    }
    if (!is_numeric($data[$field])) {
        $errors[] = "Field '$field' harus numeric.";
        return false;
    }
    return true;
}

/* -------------------------------
   5. Date Validation
--------------------------------*/
function validateDateParts(array $data, string $dayField, string $monthField, string $yearField): bool {
    global $errors;
    if (!isset($data[$dayField], $data[$monthField], $data[$yearField])) {
        $errors[] = "Tanggal belum lengkap.";
        return false;
    }
    $day = (int) $data[$dayField];
    $month = (int) $data[$monthField];
    $year = (int) $data[$yearField];

    if (!checkdate($month, $day, $year)) {
        $errors[] = "Tanggal tidak valid (pastikan hari/bulan/tahun benar).";
        return false;
    }
    return true;
}

function validateISODateString(array $data, string $field): bool {
    global $errors;
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $errors[] = "Tanggal belum diisi.";
        return false;
    }
    $parts = explode('-', $data[$field]);
    if (count($parts) !== 3) {
        $errors[] = "Format tanggal harus YYYY-MM-DD.";
        return false;
    }
    [$y, $m, $d] = $parts;
    if (!checkdate((int)$m, (int)$d, (int)$y)) {
        $errors[] = "Tanggal tidak valid.";
        return false;
    }
    return true;
}
?>
    