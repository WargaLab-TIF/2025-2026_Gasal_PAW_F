<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$newFruits = array("Mango", "Durian", "Papaya", "Banana", "Grape");

for ($i = 0; $i < count($newFruits); $i++) {
    $fruits[] = $newFruits[$i]; 
}

$arrlength = count($fruits);
echo "Panjang array saat ini adalah: $arrlength <br><br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
?>
