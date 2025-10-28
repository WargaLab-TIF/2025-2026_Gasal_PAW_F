<?php
$fruits = array("Apple", "Banana", "Mango");
$arrlength = count($fruits);
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}

echo "<br>" . "3.2.1" . "<br>";
$fruits1 = array("Manggis", "Markisa", "Melon", "Mangga", "Kelapa");
$arrlength = count($fruits1);
for($x = 0; $x < $arrlength; $x++) {
    $fruits[] = $fruits1[$x];
}
$arrlength = count($fruits);
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "Panjang Array: " . $arrlength . "<br>";

echo "<br>" . "3.2.2" . "<br>";
$veggies = array("Carrot", "Tomato", "Onion");
$arrlength = count($veggies);
for ($x = 0; $x < $arrlength; $x++) {
    echo $veggies[$x];
    echo "<br>";
}
?>