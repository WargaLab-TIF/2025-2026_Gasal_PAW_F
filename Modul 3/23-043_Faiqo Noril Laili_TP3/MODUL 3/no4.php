<?php
$height = array(
    "andy" => "176",
    "Barry" => "165",
    "charlie" => "170"
);

$height["Faiqo"] = "180";
$height["Laili"] = "169";
$height["Nuril"] = "160";
$height["April"] = "175";
$height["Dinda"] = "172";

foreach($height as $x => $x_value) {
    echo "key=" . $x . ", value=" . $x_value;
    echo "<br>";
}

echo "<br>";
$weight = array(
    "andy" => "70",
    "Barry" => "65",
    "charlie" => "68"
);


$keys = array_keys($weight);  // Mendapatkan semua kunci dari array $weight
for($i = 0; $i < count($weight); $i++) {
    echo "key=" . $keys[$i] . ", value=" . $weight[$keys[$i]];
    echo "<br>";
}

?>
