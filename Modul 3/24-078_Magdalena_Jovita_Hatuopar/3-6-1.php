<?php
$fruits = array("Apple", "Banana", "Cherry");

echo "Hasil sebelum array_push(): <br>";
var_dump($fruits);
echo "<br><br>";

array_push($fruits, "Durian", "Mango");

echo "Hasil setelah array_push(): <br>";
var_dump($fruits);
?>
