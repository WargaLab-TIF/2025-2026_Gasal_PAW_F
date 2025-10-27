<?php
// Implementasi Skrip
echo "<h4>Implementasi awal</h4>";

$height = array("Andy" => "176", "Barry" => "165", "Charlie" =>"170");
echo "Andy is " . $height['Andy'] . "cm tall" . "<br><br>";
print_r($height);
echo "<br><br>";

// 3.3.1 Tambah 5 data
echo "<h4>Implementasi menambah 5 data baru</h4>";

$height["John"] = "156";
$height["Malik"] = "169";
$height["Ashrafi"] = "170";
$height["George"] = "180";
$height["Noah"] = "189";
echo "Setelah penambahan data : ". "<br>";
print_r($height);
echo "<br><br>";

// Menampilkan nilai dengan indeks terakhir
echo "<h4>Implementasi menampilkan nilai indeks terakhir</h4>"; 

end($height);
$kunciakhir = key($height);
$nilaiakhir = end($height);
echo "Data terakhir adalah : "  .  $kunciakhir . "dengan tinggi" . $nilaiakhir . "cm";
echo "<br><br>";


// 3.3.2 Hapus 1 data 
echo "<h4>Implementasi menghapus data</h4>";

unset($height["Malik"]);
echo "Setelah menghapus data 'Malik' : <br>";
print_r($height);
echo "<br><br>";

$kunciakhir = key(array_slice($height, -1, 1, true)); 
$nilaiakhir = end($height); 

echo "Indeks terakhir adalah : " . $kunciakhir . "<br>";
echo "Nilai dari indeks terakhir adalah : " . $nilaiakhir;
echo "<br><br>";

// 3.3.3 Buat array baru
echo "<h4>Implementasi buat array baru</h4>";
$weight = array("Nana" => "67", "Nono" => "56", "Carla" => "45");
print_r($weight);
echo "<br>";

$keys = array_keys($weight);
$value = array_values($weight);
echo "Data ke-2 dari array \$weight adalah : " . $keys[1] . " = " . $value[1];

// masih salah perlu perbaikan

?>