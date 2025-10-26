<?php
function validateName($field_list, $field_name) {
    $field = trim($field_list[$field_name] ?? '');
    $pattern = "/^[a-zA-Z'-]+$/"; 
    $detailerr = ['kondisi' => true, 'eror' => ''];

    if (!is_string($field)) {
        $detailerr['eror'] = 'Username harus berupa string.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (empty($field)) {
        $detailerr['eror'] = 'Username tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!preg_match($pattern, $field)) { 
        $detailerr['eror'] = 'Username hanya boleh berisi alfabet, tanda hubung (-), atau apostrof (\').';
        $detailerr['kondisi'] = false;
    }

    $field = strtoupper($field); 
    return $detailerr;
}

function validateEmail($field_list, $field_name) {
    $field = trim(strtolower($field_list[$field_name] ?? '')); 
    $detailerr = ['kondisi' => true, 'eror' => ''];

    if (!is_string($field)) {
        $detailerr['eror'] = 'Email harus berupa string.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (empty($field)) {
        $detailerr['eror'] = 'Email tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) { 
        $detailerr['eror'] = 'Format Email tidak valid.';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}

function validateRequired($field_list, $field_name, $display_name) {
    $field = $field_list[$field_name] ?? null;
    $detailerr = ['kondisi' => true, 'eror' => ''];

    if (empty($field)) {
        $detailerr['eror'] = $display_name . ' tidak boleh kosong.';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}

function validateIP($field_list, $field_name) {
    $field = trim($field_list[$field_name] ?? '');
    $detailerr = ['kondisi' => true, 'eror' => ''];

    if (!filter_var($field, FILTER_VALIDATE_IP)) {
        $detailerr['eror'] = 'Alamat IP tidak valid.';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}

function validateFloat($field_list, $field_name) {
    $field = trim($field_list[$field_name] ?? '');
    $detailerr = ['kondisi' => true, 'eror' => ''];

    if (!is_numeric($field)) { 
        $detailerr['eror'] = 'Input harus berupa angka.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }

    $floatVal = filter_var($field, FILTER_VALIDATE_FLOAT);
    if ($floatVal === false) {
        $detailerr['eror'] = 'Nilai float tidak valid.';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}

function validateDateField($field_list, $field_name) {
    $field = trim($field_list[$field_name] ?? '');
    $detailerr = ['kondisi' => true, 'eror' => ''];

    if (empty($field)) {
        $detailerr['eror'] = 'Tanggal tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }

    $parts = explode('-', $field);
    if (count($parts) === 3) {
        $year = (int)$parts[0];
        $month = (int)$parts[1];
        $day = (int)$parts[2];
        if (!checkdate($month, $day, $year)) {
            $detailerr['eror'] = 'Tanggal tidak valid.';
            $detailerr['kondisi'] = false;
        }
    } else {
        $detailerr['eror'] = 'Format tanggal harus YYYY-MM-DD.';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}
?>
