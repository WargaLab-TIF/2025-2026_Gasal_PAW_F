<?php
//no 3.2.1 guysss
$fruits = array("Avocado","Blueberry","Cherry");
$arrlength = count($fruits);

$moreFruits = array("Mango", "Orange", "Durian", "Apple", "Banana");
for($x = 0; $x < $arrlength + count($moreFruits); $x++){
    if ($x >= $arrlength) {
        $fruits[] = $moreFruits[$x - $arrlength];
    }echo($fruits[$x] . " ");
}
echo "<br>";
echo "<br>";

//no 3.2.2 guysss
$veggies = ["tomat","brokoli","buncis"];
$arrlength = count($veggies);

for($i=0; $i < $arrlength ; $i++){
    echo($veggies[$i]) . " ";
}
?>