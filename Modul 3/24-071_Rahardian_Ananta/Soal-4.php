<?php

$height = array("Andy" => "176", "Bany" => "165", "Charlie" => "170");

foreach ($height as $x => $x_value){
	echo "key=" . $x . ", Value=" .$x_value; 
	echo "<br>";
}
echo "<br>";

# 3.4.1
/*
for ($i = 0; $i <= 5; $i++){
	$height["data ke-$i "] = "170";
}*/
$height_baru = array("Yanto" => "171", "Cipto" => "160", "Yasuo" => "145", "Ashe" => "150", "Yuumi" => "75");
foreach ($height_baru as $x => $x_value){
	$height[$x] = $x_value;
}

foreach ($height as $x => $x_value){
	echo "key=" . $x . ", Value=" .$x_value; 
	echo "<br>";
}

echo "<br>";
# 3.4.2
$weight = array("Yasuo" => "271", "Yone" => "160", "Lux" => "175");

foreach ($weight as $x => $x_value){
	echo "Nama = " . $x . ", Berat = " .$x_value . " in kg"; 
	echo "<br>";
}


