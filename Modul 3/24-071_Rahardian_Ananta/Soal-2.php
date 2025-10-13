<?php

$fruits = array("Avocado","Blueberry","Cherry");
$arrlenght = count($fruits);

# 3.2.1
for ($x = 0; $x < $arrlenght; $x++){
	echo $fruits[$x];
	echo "<br>";
}

for ($i = 0; $i < 5; $i++){
	$fruits[] = "buah-$i";
}

$arrlenght = count($fruits);
echo 'Panjang array $fruits ' . $arrlenght . "<br><br>" ;

for ($x = 0; $x < $arrlenght; $x++){
	echo $fruits[$x];
	echo "<br>";
}
echo "<br>";


# 3.2.2
$veggies = array("Mengkudu","Buah naga","Sirsak");
$arrlenght = count($veggies);

# 3.2.1
for ($x = 0; $x < $arrlenght; $x++){
	echo $veggies[$x];
	echo "<br>";
}