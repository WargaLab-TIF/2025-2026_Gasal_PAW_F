<?php
// 3.1.1
$fruits = array("Avocado", "Blueberry", "Cherry");
$data_baru = array("apple", "banana", "orange", "grape", "chicken");
for ($z = 0; $z < count($data_baru); $z++) {
    $fruits[] = $data_baru[$z];
    
}
$arrlength = count($fruits);
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}


// 3.2.2
$veggies = array("a","b","c");
for ($x = 0; $x < count($veggies); $x++) {
    echo $veggies[$x];
    echo "<br>";
}
?>
