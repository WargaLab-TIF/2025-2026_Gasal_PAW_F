<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
echo "Andy is " . $height['Andy'] . " cm tall." . "<br>";

echo "<br>" . "3.3.1" . "<br>";
$height["Klee"] = "127";
$height["Diona"] = "135";
$height["Qiqi"] = "140";
$height["Furina"] = "166";
$height["Keqing"] = "158";
print_r($height);
$last_key = array_key_last($height);
echo "<br>" . "Indeks terakhir: $last_key" . "<br>" .  "Nilai: " . $height[$last_key] . "<br>";

echo "<br>" . "3.3.2" . "<br>";
unset($height["Keqing"]); 
print_r($height);
$last_key = array_key_last($height);
echo "<br>" . "Setelah dihapus indeks terakhir: $last_key" . "<br>" .  "Nilai: " . $height[$last_key] . "<br>";

echo "<br>" . "3.3.3" . "<br>";
$weight = array("Noelle"=>"50", "Raiden"=>"60", "Mona"=>"52");
print_r($weight);
echo "<br>" . "Raiden weight is " . $weight['Raiden'] . " kg.";
?>