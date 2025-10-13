<?php

$height = array("Andy" => "176", "Bany" => "165", "Charlie" => "170");
echo "Andy is " . $height['Andy'] . "cm tall";
echo "<br>";

# 3.3.1
for ($i = 0; $i < 5; $i++){
	$height["data ke-$i "] = "170";
}

echo "data ke-5 " . $height["data ke-4 "] . "cm tall";
echo "<br>";

# 3.3.2
unset($height["Bany"]);
echo "data ke-5 " . $height["data ke-4 "] . "cm tall";
echo "<br>";

$weight = array("Andy" => "76", "Bany" => "65", "Charlie" => "70");
echo "Bany is " . $weight['Bany'] . "kg weight";

