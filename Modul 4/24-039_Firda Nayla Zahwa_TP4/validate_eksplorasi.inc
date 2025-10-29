<?php 
function validasiNama($data) { 
    return preg_match("/^[a-zA-Z ]+$/", $data); 
} 
function validasiEmail($data) { 
    return filter_var($data, FILTER_VALIDATE_EMAIL); 
} 
function validasiUmur($data) { 
    return is_numeric($data); 
} 
function validasiTanggal($data) { 
    $pecah = explode('-', $data); 
    if (count($pecah) == 3) { 
        $tahun = $pecah[0]; 
        $bulan = $pecah[1]; 
        $hari = $pecah[2]; 
        return checkdate($bulan, $hari, $tahun); 
    } 
    return false; 
} 
?> 
