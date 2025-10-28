<?php
$mahasiswa1 = array("Alex", "Bianca", "Charlie");
$mahasiswa2 = array("David", "Elena", "Fahri");

$semua_mahasiswa = array_merge($mahasiswa1, $mahasiswa2);

echo "Hasil setelah array_merge(): <br>";
var_dump($semua_mahasiswa);
?>
