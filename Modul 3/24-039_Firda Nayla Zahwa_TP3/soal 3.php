<?php
// Array asosiatif awal berisi nama dan tinggi badan
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
// menambah 5 data
$height["Dina"] = 155;
$height["Eka"] = 172;
$height["Fajar"] = 180;
$height["Gina"] = 158;
$height["Hani"] = 167;

print_r($height);


end($height); 
echo "<br><br>Indeks terakhir: " . key($height);
echo "<br>Nilai pada indeks terakhir: " . current($height);
echo "<br>";
?>

<?php
unset($height["Dina"]); //Dina dihapus
print_r($height);

$keys = array_keys($height);
$last_key = end($keys);
echo "<br>";
echo "Indeks terakhir sekarang: $last_key ";
echo "<br>";
echo "Nilai indeks terakhir sekarang: " . end($height);
?>

<?php
$weight = ["Alex" => 60, "Bianca" => 55, "Candice" => 50];
$keys = array_keys($weight);
echo "Data ke-2 dari array weight: " . $weight[$keys[1]];
?>