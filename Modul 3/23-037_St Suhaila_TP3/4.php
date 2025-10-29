<?php
$height = array(
    "andy" => "176",
    "Barry" => "165",
    "charlie" => "170"
);

$height["David"] = "180";
$height["Edward"] = "169";
$height["Fiona"] = "160";
$height["George"] = "175";
$height["Helen"] = "172";

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
