<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
echo "Andy is " . $height['Andy'] ." cm tall";

#3.3.1
$height["Umam"] = "175";
$height["Fajar"] = "178";
$height["Mas"] = "169";
$height["Arfa'"] = "180";
$height["Evan"] = "172";
echo "<br>";
echo "Indeks terakhir: " . end($height);

#3.3.2
echo "<br>";
unset($height["Evan"]);
end($height);
echo "Indeks terakhir: " . end($height);

#3.3.3
echo "<br>";
$weight = array("Alex" => 60, "Bianca" => 55, "Candice" => 50);
$keys = array_keys($weight);
echo "Data ke-2: " . $weight[$keys[1]];

