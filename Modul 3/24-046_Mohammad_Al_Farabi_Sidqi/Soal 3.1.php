<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] ." and ".$fruits[2]; 


#3.1.1
echo "<br>";
array_push($fruits, "Grapes", "Melon", "Apple", "Papaya", "Kiwi");
echo end($fruits);
echo "<br>Indeks tertinggi: " . key($fruits);

#3.1.2
echo "<br>";
unset($fruits[1]);
echo end($fruits);
echo "<br>Indeks tertinggi: " . key($fruits);

#3.1.3
echo "<br>";
$veggies = array("Carrot", "Sawi", "Broccoli");
for ($i=0;$i<count($veggies);$i++) {
    echo $veggies[$i] . "<br>";
}