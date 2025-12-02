<?php
// Data awal
echo "<h4>Implementasi awal</h4>";

$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
print_r($height);
echo "<br><br>";

// 3.4.1 menambah 5 data baru
echo "<h4>Implementasi menambah 5 data baru</h4>";
$height["John"] = "156";
$height["Malik"] = "169";
$height["Ashrafi"] = "170";
$height["George"] = "180";
$height["Noah"] = "189";
echo "Data setelah menambah 5 data baru :";
echo "<br>";
foreach($height as $x => $x_value){
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}

echo "<br>";

// 3.4.2 Buat array baru
echo "<h4>Implementasi membuat array baru</h4>";
$weight = array("Nana" => "67", "Nono" => "56", "Carla" => "45");
echo "Data baru :";
echo "<br>";
foreach($weight as $x => $x_value){
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
?>