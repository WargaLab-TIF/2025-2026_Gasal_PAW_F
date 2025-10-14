<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

#3.4.1
$height["Farel"] = "175";
$height["Arif"] = "178";
$height["Mas"] = "169";
$height["Wahyu"] = "180";
$height["Nizam"] = "172";
foreach ($height as $x => $x_value) {
    echo "Key= $x , Value= $x_value";
    echo "<br>";
}

#3.4.2
echo "<br>";
$weight = ["Ashif" => 60, "Bagus" => 55, "Rian" => 50];
foreach ($weight as $x => $x_value) {
    echo "Key= $x , Value= $x_value";
    echo "<br>";
}