<?php
$fruits = array("Avocado","Blueberry","Cherry");
$arrlenght = count($fruits);
$num = $arrlenght + 5;

for ($x = 0; $x < $num; $x ++) {
    if ($x < 3) {
        echo $fruits[$x];
        echo "<br>";
    } else {
        array_push($fruits,"tambah");
        echo $fruits[$x];
        echo "<br>";
    }
}

echo (count($fruits)-1);
echo "<br>";
$vegis = array("aduhai","aduhai","aduhai");
for ($i = 0; $i < 3; $i ++) {
    echo $vegis[$i];
    echo "<br>";
}


?>