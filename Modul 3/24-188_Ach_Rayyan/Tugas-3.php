<?php
echo "<h2>3.3 Deklarasi dan Akses Array Asosiatif</h2>";
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

echo    $height["Andy"] . "<br><br>";


$height["rendi"] = "160";
$height["Lisa"] = "175";
$height["Rayyan"] = "168";
$height["anin"] = "180";
$height["Hannah"] = "172";

print_r($height);
echo "<br><br>";

echo array_key_last($height);
echo "<br><br>";

unset($height["Barry"]);
print_r($height);
echo "<br><br>";

echo array_key_last($height);
echo "<br><br>";

$weight = array(
    "Rendi" => "250",
    "Safri" => "65",
    "Jihad" => "56"
);

echo "<b>Array :</b><br>";
print_r($weight);
echo "<br><br>";

$keys = array_keys($weight);       
$secondKey = $keys[1];               
echo $secondKey . " = " . $weight[$secondKey] . " kg";
?>
