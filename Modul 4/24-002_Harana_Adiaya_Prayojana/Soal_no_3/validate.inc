<?php
function validateName($field_list, $field_name, &$err){
    if (!isset($field_list[$field_name]) || $field_list[$field_name]===""){
        $err[$field_name]="$field_name Harus di isi";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name])){
        $err[$field_name]="$field_name Invalid!";
        return false;}
    return true;
};
function validateEmail($field_list, $field_name, &$err){
    if (!isset($field_list[$field_name]) || $field_list[$field_name]===""){
        $err[$field_name]="$field_name Harus di isi";
        return false;
    }
    
    $tes_email='/^[a-zA-Z]+@[a-zA-Z]+\.[a-zA-z]{2,}$/';
    if (!preg_match($tes_email, $field_list[$field_name])){
        $err[$field_name]="$field_name Invalid!";
        return false;}
    return true;
}
function validateLength($field,$list,&$err,$min=3,$max=50){
    if(!isset($field[$list]) || strlen(trim($field[$list]))<$min || strlen(trim($field[$list]))>$max){
        $err[$list]="$list harus $min-$max karakter.";
        return false;
    }
    return true;
}
function validateEmailFilter($field,$list,&$err){
    if(!isset($field[$list]) ||!filter_var($field[$list],FILTER_VALIDATE_EMAIL)){
        $err[$list]="$list tidak valid (filter).";
        return false;
    }
    return true;
}
function validateURL($field,$list,&$err){
    if(!isset($field[$list]) ||!filter_var($field[$list],FILTER_VALIDATE_URL)){
        $err[$list]="$list bukan URL yang benar.";
        return false;
    }
    return true;
}
function validateIP($field,$list,&$err){
    if(!isset($field[$list]) || !filter_var($field[$list],FILTER_VALIDATE_IP)){
        $err[$list]="$list bukan IP valid.";
        return false;
    }
    return true;
}
function validateNumeric($field,$list,&$err){
    if(!isset($field[$list]) || !is_numeric($field[$list])){
        $err[$list]="$list harus angka.";
        return false;
    }
    return true;
}
function validateInteger($field,$list,&$err){
    if(!isset($field[$list]) || !is_int($field[$list]) && !ctype_digit($field[$list])){
        $err[$list]="$list harus bilangan bulat.";
        return false;
    }
    return true;
}
function validateDate($field,$list,&$err,$format='Y-m-d'){
    $d=DateTime::createFromFormat($format,$field[$list]??'');
    if(!$d || $d->format($format)!==$field[$list]){
        $err[$list]="$list tanggal tidak valid (format $format).";
        return false;
    }
    return true;
}
?>