<?php
$height = array("Andy" => "176",
                "Barry" => "165",
                "Charlie" => "170",
);

$height["tambah1"] = "221";
$height["tambah2"] = "182";
$height["tambah3"] = "162";
$height["tambah4"] = "182";
$height["tambah5"] = "162";

foreach ($height as $x => $x_value) {
    echo "Key = ". $x . " Value = ". $x_value;
    echo "<br>";
}

$weight = array(
    "satu" => "1",
    "dua" => "2",
    "tiga" => "3"
); 


foreach ($weight as $a => $b) {
    echo "key = $a, value = $b <br>";
}

?>