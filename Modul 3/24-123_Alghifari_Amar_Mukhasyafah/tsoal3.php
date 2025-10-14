<?php
$height = array("Andy" => "176",
                "Barry" => "165",
                "Charlie" => "170",
);

$height['Tambah1'] = "192";
$height['Tambah2'] = "191";
$height['Tambah3'] = "194";
$height['Tambah4'] = "196";
$height['Tambah5'] = "199";

echo "Andy is ". $height['Andy']. "cm tall. ";
echo "<br>";

$lk = array_key_last($height);

echo "Nilai/Value dengan indeks terakhir dari array adalah => ". $height[$lk];

unset($height["Tambah3"]);
echo "<br>";

echo "Nilai/value dari height indeks terkahir adalah => ". $height[$lk];

$weight = array(
    "satu" => "1",
    "dua" => "2",
    "tiga" => "3"
); 

echo "<br>";

$values = array_values($weight);
echo "Nilai indeks kedua adalah => ". $values[1];

?>