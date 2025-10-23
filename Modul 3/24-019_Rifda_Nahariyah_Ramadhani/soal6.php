<!-- 3.6.1 Implementasi array_push() -->
<?php
$fruits = array("Apple", "Banana");
array_push($fruits, "Cherry", "Durian");

print_r($fruits);
echo "<br>";
echo "<br>";
?>

<!-- 3.6.2 Implementasi array_merge() -->
<?php
$fruits = array("Apple", "Banana");
$veggies = array("Carrot", "Spinach");

$merged = array_merge($fruits, $veggies);

print_r($merged);
echo "<br>";
echo "<br>";
?>

<!-- 3.6.3 Implementasi array_values() -->
<?php
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
$values = array_values($height);

print_r($values);
echo "<br>";
echo "<br>";
?>

<!-- 3.6.4 Implementasi array_search() -->
<!-- <?php
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
$key = array_search(170, $height);

echo "Nilai 170 ditemukan pada key: " . $key;
echo "<br>";
echo "<br>";
?> -->

<!-- 3.6.5 Implementasi array_filter() -->
<?php
$numbers = array(10, 25, 30, 45, 50);

$filtered = array_filter($numbers, function($num) {
    return $num > 30;
});

print_r($filtered);
echo "<br>";
echo "<br>";
?>

<!-- 3.6.6 Implementasi berbagai fungsi sorting pada array -->

<!-- sort() → Mengurutkan nilai secara menaik (ascending) -->
<?php
$numbers = array(5, 2, 8, 1);
sort($numbers);
print_r($numbers);
echo "<br>";
echo "<br>";
?>

<!-- rsort() → Mengurutkan nilai secara menurun (descending) -->
<?php
$numbers = array(5, 2, 8, 1);
rsort($numbers);
print_r($numbers);
echo "<br>";
echo "<br>";
?>

<!-- asort() → Mengurutkan array asosiatif berdasarkan nilai, mempertahankan key -->
<?php
$height = array("Andy"=>176, "Barry"=>165, "Charlie"=>170);
asort($height);
print_r($height);
echo "<br>";
echo "<br>";
?>

<!-- ksort() → Mengurutkan array asosiatif berdasarkan key (abjad) -->
<?php
$height = array("Charlie"=>170, "Andy"=>176, "Barry"=>165);
ksort($height);
print_r($height);
echo "<br>";
echo "<br>";
?>

<!-- arsort() → Mengurutkan nilai secara menurun (descending) sambil mempertahankan key -->
<?php
$height = array("Andy"=>176, "Barry"=>165, "Charlie"=>170);
arsort($height);
print_r($height);
echo "<br>";
?>