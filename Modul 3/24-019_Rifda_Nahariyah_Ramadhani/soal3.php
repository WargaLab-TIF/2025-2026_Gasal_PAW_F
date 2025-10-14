<!-- kode awal -->
<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
echo "Andy is " . $height['Andy'] . " cm tall."."<br><br>";
?>

<!--3.3.1 Tambahkan 5 data baru ke array $height -->
<?php
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170",
    "David" => "180",
    "Evan" => "172",
    "Putri" => "169",
    "Zidan" => "175",
    "Sari" => "168"
);

foreach ($height as $name => $value) {
    echo $name . " is " . $value . " cm tall.<br>";
}

$lastKey = array_key_last($height);
echo "<br>Nilai dengan indeks terakhir: " . $height[$lastKey] . " (Key: " . $lastKey . ")". "<br><br>";
?>

<!-- 3.3.2 Hapus 1 data tertentu dari $height -->
<?php
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170",
    "David" => "180",
    "Evan" => "172",
    "Putri" => "169",
    "Zidan" => "175",
    "Sari" => "168"
);

unset($height["Evan"]);

foreach ($height as $name => $value) {
    echo $name . " is " . $value . " cm tall.<br>";
}

$lastKey = array_key_last($height);
echo "<br>Nilai dengan indeks terakhir: " . $height[$lastKey] . " (Key: " . $lastKey . ")". "<br>";
?>

<!-- 3.3.3 Buat array baru $weight dan tampilkan data ke-2 -->
<?php
$weight = array("Andy" => "65", "Barry" => "70", "Charlie" => "60");

$keys = array_keys($weight);
echo "Data ke-2 dari array: " . $weight[$keys[1]] . " kg (" . $keys[1] . ")";
?>
