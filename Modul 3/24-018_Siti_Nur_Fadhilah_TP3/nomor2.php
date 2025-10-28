<?php
$fruits = array("Avocado","Blueberry","Cherry");
$arrlenght = count($fruits);

for ($x = 0; $x < $arrlenght; $x ++) {
        echo $fruits[$x];
        echo "<br>";
}

/* == Jawaban 3.2.1 == */
echo "<br>";
echo "Data Baru: ";
echo "<br>";

// tambah data baru 
$fruits[] = "Orange";
$fruits[] = "Apple";
$fruits[] = "Mango";
$fruits[] = "Banana";
$fruits[] = "Grape";

$arrlength = count($fruits);

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "Jumlah data: " . count($fruits);
echo "<br>";


/* == Jawaban 3.2.2 == */
// array baru
echo "<br>";
echo "Array Baru: ";
echo "<br>";
$veggies = array("Tomato", "Brocoli", "Cucumber");
$arrlength = count($veggies);

for ($x = 0; $x < $arrlength; $x++) {
    echo $veggies[$x];
    echo "<br>";
}
?>