<?php
$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
echo "Andy is ".$height['Andy']." cm tall.";
// 3.3.1.
echo '<br>3.3.1';
echo "<br><br>";
$height["Rendi"] = "177";
$height["Lemonaru"] = "199";
$height["senku"] = "145";
$height["gara"] = "172";
$height["nobita"] = "160";
echo "Indeks terakhir dari height adalah ".array_key_last($height)." sedangkan valuenya adalah ".$height[array_key_last($height)];
// 3.3.2.
echo '<br>3.3.2';
echo "<br><br>";
unset($height["nobita"]);
echo "Indeks terakhir dari height adalah ".array_key_last($height)." sedangkan valuenya adalah ".$height[array_key_last($height)];
// 3.3.2.
echo '<br>3.3.3';
echo "<br><br>";
$weight=["Andri"=>"76","Bani"=>"55","Suta"=>"25"];
$indeks=array_keys($weight);
$weightKe2=$indeks[1];
echo "Indeks terakhir dari height adalah ".$weightKe2." sedangkan valuenya adalah ".$weight[$weightKe2];
?>