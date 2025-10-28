<?php

//3.1.1 guysss
$fruits = array("Avocado","Blueberry","Cherry");
echo "I like ". $fruits[0].", ".$fruits[1]." and ".$fruits[2]."." . "<br>";
array_push($fruits, "banana", "apple", "orange","grape","mango");

var_dump($fruits);
echo "<br>";
echo ($fruits[count($fruits)-1])." indeks tertinggi : ". count($fruits)-1 ."<br>";
echo "<br>";

//3.1.2 guysss
array_splice($fruits,3,1);
var_dump($fruits);
echo "<br>";
echo ($fruits[count($fruits)-1])." indeks tertinggi : ". count($fruits)-1 ."<br>";
echo "<br>";

//3.1.3 guysss
$veggies = array("bayam","tomat","wortel");
echo $veggies[0].", ".$veggies[1]." and ".$veggies[2].".";

?>