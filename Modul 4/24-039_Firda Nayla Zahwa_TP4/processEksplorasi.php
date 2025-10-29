<?php 
require 'validate_eksplorasi.inc'; 

$nama = $_POST['nama'] ?? ''; 
$email = $_POST['email'] ?? ''; 
$umur = $_POST['umur'] ?? '';
$tgl = $_POST['tgl'] ?? ''; 
$pesan = []; 

if (!validasiNama($nama)) { 
$pesan[] = "Nama hanya boleh huruf dan tidak boleh kosong!"; 
} 

if (!validasiEmail($email)) { 
$pesan[] = "Format email tidak valid!"; 
} 

if (!validasiUmur($umur)) { 
$pesan[] = "Umur harus berupa angka!"; 
} 

if (!validasiTanggal($tgl)) { 
$pesan[] = "Tanggal lahir tidak valid!"; 
} 

if (count($pesan) == 0) { 
    echo "<h3 style='color:green;'>Semua data valid!</h3>"; 
} else { 
    echo "<h3 style='color:red;'>Terjadi Kesalahan:</h3>"; 
    foreach ($pesan as $p) { 
        echo "- $p <br>"; 
    } 
} 
?>