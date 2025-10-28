<?php
function validateName($field_list, $field_name, &$error) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $error[$field_name] = "kolom $field_name harus diisi.";
        return false;
    }
    $format = "/^[a-zA-Z'-]+$/";
    if (!preg_match($format, $field_list[$field_name])){
        $error[$field_name] = "kolom $field_name hanya boleh berisi huruf.";
        return false;
    }
    return true;
}

function cekemail($field_list, $field_email, &$error) {
    if (!isset($field_list[$field_email]) || empty($field_list[$field_email])) {
        $error[$field_email] = "kolom $field_email harus diisi.";
        return false;
    }

    if (!filter_var($field_list[$field_email], FILTER_VALIDATE_EMAIL)) {
        $error[$field_email] = "Format email tidak valid.";
        return false;
    }

    return true;
}

function cekumur ($field_list, $field_num, &$error) {
    if (!isset($field_list[$field_num]) || empty(trim($field_list[$field_num]))) {
        $error[$field_num] = "kolom $field_num harus diisi.";
        return false;
    }

    if (!filter_var($field_list[$field_num], FILTER_VALIDATE_INT ) || !is_numeric($field_list[$field_num]) || !is_int($field_list[$field_num])) {
        $error[$field_num] = "Format Umur tidak valid.";
        return false;
    }
    return true;
}

function cekurl (&$field_list, $field_url, &$error) {
    $field_list[$field_url] = strtolower(trim($field_list[$field_url]));

    if (!isset($field_list[$field_url]) || empty(trim($field_list[$field_url]))) {
        $error[$field_url] = "kolom $field_url harus diisi.";
        return false;
    }

    if (!filter_var($field_list[$field_url], FILTER_VALIDATE_URL)){
        $error[$field_url] = "URL Website tidak valid";
        return false;
    }
    return true;
}

function cektanggal($field_list, $field_tanggal, &$error) {
    if (!isset($field_list[$field_tanggal]) || empty(trim($field_list[$field_tanggal]))) {
        $error[$field_tanggal] = "Kolom $field_tanggal harus diisi.";
        return false;
    }

    $input_tanggal = trim($field_list[$field_tanggal]);
    $bagian = explode('-', $input_tanggal);

    if (count($bagian) !== 3) {
        $error[$field_tanggal] = "Format tanggal lahir harus dd-mm-yyyy.";
        return false;
    }

    list($hari, $bulan, $tahun) = $bagian;

    if (!ctype_digit($hari) || !ctype_digit($bulan) || !ctype_digit($tahun)) {
        $error[$field_tanggal] = "Tanggal lahir hanya boleh berisi angka.";
        return false;
    }

    $hari = (int)$hari;
    $bulan = (int)$bulan;
    $tahun = (int)$tahun;

    if (!checkdate($bulan, $hari, $tahun)) {
        $error[$field_tanggal] = "Format tanggal lahir tidak valid.";
        return false;
    }

    return true;
}

function ceknegara(&$field_list, $field_negara, &$error){
    $field_list[$field_negara] = strtoupper(trim($field_list[$field_negara]));

    if (!isset($field_list[$field_negara]) || empty(trim($field_list[$field_negara]))) {
        $error[$field_negara] = "kolom $field_negara harus diisi.";
        return false;
    }

    if (!is_string($field_list[$field_negara]) || !ctype_alpha($field_list[$field_negara])){
        $error[$field_negara] = "Format Negara harus berupa string.";
        return false;
    }
    return true;
}

function cekfloat($field_list, $field_nilai, &$error) {
    if (!isset($field_list[$field_nilai]) || empty(trim($field_list[$field_nilai]))) {
        $error[$field_nilai] = "Kolom Nilai $field_nilai harus diisi.";
        return false;
    }

    if (!filter_var($field_list[$field_nilai], FILTER_VALIDATE_FLOAT) || !is_float($field_list[$field_nilai])) {
        $error[$field_nilai] = "Kolom Nilai $field_nilai harus berupa angka desimal (gunakan titik untuk pecahan).";
        return false;
    }

    return true;
}

function cekip(&$field_list, $field_ip, &$error) {
    $field_list[$field_ip] = filter_input(INPUT_POST, $field_ip, FILTER_SANITIZE_SPECIAL_CHARS);

    if (!isset($field_list[$field_ip]) || empty(trim($field_list[$field_ip]))) {
        $error[$field_ip] = "Kolom Alamat $field_ip harus diisi.";
        return false;
    }

    if (!filter_var($field_list[$field_ip], FILTER_VALIDATE_IP)) {
        $error[$field_ip] = "Format IP tidak valid";
        return false;
    }

    return true;
}




?>
