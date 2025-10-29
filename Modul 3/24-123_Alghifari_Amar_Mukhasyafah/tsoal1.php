<?php
$fruits = array("avocado","Blueberry","Cherry");
echo "i like ". $fruits[0]. ", ". $fruits[1] . "And ". $fruits[2]. ".";

echo "<br>";
array_push($fruits,"1","2","3","sebelum akhir","terakhr");
// var_dump($fruits);

// echo $fruits[count($fruits) -1]. "<br>";

echo "menampilkan nilai dari indeks tertinggi yaitu => ". ($fruits[count($fruits) -1]);
echo "<br>";

echo "index tertinggi dari array adalah => ". (count($fruits)-1). "<br>";

echo "<br>";
echo "menghapus $fruits[2]";
echo "<br>";

unset($fruits[2]);

echo "Menampilkan index terakhr saat ini => ". ($fruits[count($fruits)]);
echo "<br>";
echo "menampilkan index tertinggi pada array saat ini adalah => ". (count($fruits)-1);
echo "<br>";


$veggis = array("satu","dua","tiga");
var_dump($veggis);

?>


