<?php
// sort
$angka = array(40, 10, 50, 30, 20);
sort($angka);
echo("Ini hasil dari fungsi sort(): ");
var_dump($angka);
echo"<br><br>";

// rsort
$number = array(40, 10, 50, 30, 20);
rsort($number);
echo("Ini hasil dari fungsi rsort(): ");
var_dump($number);
echo"<br><br>";

// asort
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
asort($height);
echo("Ini hasil dari fungsi asort(): ");
var_dump($height);
echo"<br><br>";

// arsort
$heights = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
arsort($heights);
echo("Ini hasil dari fungsi arsort(): ");
var_dump($heights);
echo"<br><br>";

// ksort
$weight = array("Alfan" => 76, "Budi" => 65, "Cipung" => 70);
ksort($weight);
echo("Ini hasil dari fungsi ksort(): ");
var_dump($weight);
echo"<br><br>";

// krsort
$weight = array("Alfan" => 76, "Budi" => 65, "Cipung" => 70);
krsort($weight);
echo("Ini hasil dari fungsi krsort(): ");
var_dump($weight);
echo"<br><br>";
?>
