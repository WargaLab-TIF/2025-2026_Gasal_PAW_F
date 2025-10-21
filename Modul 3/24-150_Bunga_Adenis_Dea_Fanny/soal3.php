<?php
// Array awal (sesuai soal)
$height = ["Andy"=>"176", "Barry"=>"165", "Charlie"=>"170"];

// 3.3.1 Tambahkan 5 data baru
$height += [
    "Dewi"   => "160",
    "Eka"    => "158",
    "Fajar"  => "172",
    "Gina"   => "168",
    "Hadi"   => "174"
];

// Tampilkan nilai pada kunci (key) terakhir
$kunciTerakhir = array_key_last($height);    
echo "3.3.1 — Tampilkan nilai pada kunci (key) terakhir:<br>";  
echo "Kunci terakhir: $kunciTerakhir, Nilai: {$height[$kunciTerakhir]} cm<br>";
echo "<br>";


// 3.3.2 Hapus 1 data tertentu, lalu tampilkan nilai pada kunci terakhir 
unset($height["Barry"]);   

$kunciTerakhir = array_key_last($height);
echo "3.3.2 — Tampilkan nilai pada kunci (key) terakhir setelah di hapus 1 data:<br>"; 
echo "Setelah menghapus 'Barry', kunci terakhir adalah: $kunciTerakhir, Nilai: {$height[$kunciTerakhir]} cm<br><br>";


// 3.3.3 Buat array baru $weight (3 data) 
$weight = ["Andy"=>65, "Barry"=>58, "Charlie"=>62];

// Tampilkan data ke-2 dari $weight 
$daftarKunci = array_keys($weight);
$kunciKedua  = $daftarKunci[1];
echo "3.3.3 — Tampilkan data ke-2:<br>"; 
echo "Data ke-2 pada weight: $kunciKedua = {$weight[$kunciKedua]} kg";
?>
