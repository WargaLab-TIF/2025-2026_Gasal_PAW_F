<?php
$fruits = ["Apple", "Banana", "Cherry"];

array_push($fruits, "Avocado", "Blueberry", "Grape", "Watermelon", "Melon");

// print_r($fruits);

// echo "<br><br>nilai Indeks tertinggi: " . (count($fruits) - 1);
// echo "<br>Data indeks tertinggi: " . end($fruits);
?>

<?php
// unset($fruits[2]); 

// print_r($fruits);
// echo "<br><br>Indeks tertinggi: " . end($fruits);
// echo "<br><br>Indeks tertinggi sekarang: "  . (count($fruits) - 1);
?>

<?php
$veggies = ["Wortel", "Broccoli", "Tomat"];
foreach ($veggies as $v) {
    echo $v . "<br>";
}
?>

