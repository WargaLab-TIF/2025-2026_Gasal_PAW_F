<?php

$fruits = array("Avocado","Blueberry","Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2]. ".";

# 3.1.1
$fruits[] = "Pinaple";
$fruits[] = "Durian";
$fruits[] = "Banana";
$fruits[] = "Apple";
$fruits[] = "grapes";

echo "<br>";
echo $fruits[7];


# 3.1.1
unset($fruits[2]);

echo "<br>";
echo $fruits[7];

# 3.1.3
$veggies = array("Mengkudu","Buah naga","Sirsak");
echo "I like " . $veggies[0] . ", " . $veggies[1] . " and " . $veggies[2]. ".";