<?php
//3. 1. Deklarasi dan akses array terindeks
$fruit= array("Avocado", "Blueberry", "Cherry",);
echo "I like ". $fruit[0]. ", " . $fruit[1]. " and " . $fruit[2]. ".";
echo "<br>";

//3.1.1
$fruit[] = "Durian";
$fruit[] = "Mango";
$fruit[] = "Banana";
$fruit[] = "Apple";
$fruit[] = "Orange";
$hitung_idx= count($fruit ) - 1;
echo "indeks tertinggi dari fruit adalah: " . $hitung_idx;
echo "<br>";
echo "nilai dengan indeks tertinggi adalah: " . $fruit[$hitung_idx];
echo "<br>";

//3.1.2
unset($fruit[5]);
$hitung_idx_2= count($fruit ) - 1;
echo "indeks tertinggi dari fruit adalah: " . $hitung_idx_2;
echo "<br>";
echo "nilai dengan indeks tertinggi adalah: " . $fruit[$hitung_idx_2];
echo "<br>";

//3.1.3
$veggies = array("kangkung", "bayam", "kol");
foreach($veggies as $sayuran){
    echo $sayuran. " ";
}
?>

