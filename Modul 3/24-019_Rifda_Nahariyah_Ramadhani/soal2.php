<!-- kode awal -->
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}
echo "<br>";
?>
<!-- 3.2.1 Menambah 5 data baru -->
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

$extraFruits = array("Durian", "Mango", "Orange", "Pineapple", "Strawberry");

for ($i = 0; $i < count($extraFruits); $i++) {
    $fruits[] = $extraFruits[$i]; 
}

$arrlength = count($fruits);

for($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}
echo "<br>";
?>

<!--3.2.2 Buat array baru $veggies dan tampilkan dengan FOR -->
<?php
$veggies = array("Carrot", "Broccoli", "Spinach");
$arrlength = count($veggies);

for($x = 0; $x < $arrlength; $x++) {
    echo $veggies[$x] . "<br>";
}
?>