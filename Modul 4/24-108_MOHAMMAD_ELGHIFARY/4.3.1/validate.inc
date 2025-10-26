<?php
function validateName($field_list, $field_name)
{
    $field = $field_list[$field_name] ?? '';
    $pattern = "/^[a-zA-Z'-]+$/"; 
    $detailerr=['kondisi'=>true,'eror'=>''];
    if (empty($field)) {
        $detailerr['eror'] = 'Surname tidak boleh kosong.';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    if (!preg_match($pattern, $field)) {
        $detailerr['eror'] = 'Surname hanya boleh berisi alfabet (a-z, A-Z), tanda hubung (-), atau apostrof (\').';
        $detailerr['kondisi'] = false;
        return $detailerr;
    }
    return $detailerr;
}
?>