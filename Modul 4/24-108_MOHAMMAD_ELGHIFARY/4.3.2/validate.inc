<?php
function validateName($field_list, $field_name) {
    $field = $field_list[$field_name] ?? '';
    $pattern = "/^[a-zA-Z'-]+$/"; 
    $detailerr=['kondisi'=>true,'eror'=>''];
    
    if (empty($field)) {
        $detailerr['eror'] = 'Username tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!preg_match($pattern, $field)) {
        $detailerr['eror'] = 'Username hanya boleh berisi alfabet, tanda hubung (-), atau apostrof (\').';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}

function validateEmail($field_list, $field_name) {
    $field = $field_list[$field_name] ?? '';
    $detailerr=['kondisi'=>true,'eror'=>''];
    
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
    $detailerr=['kondisi'=>true,'eror'=>''];
    
    if (empty($field)) {
        $detailerr['eror'] = $display_name . ' tidak boleh kosong.';
        $detailerr['kondisi'] = false;
    }
    return $detailerr;
}
?>