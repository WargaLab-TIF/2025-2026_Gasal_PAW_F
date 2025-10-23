<!-- Array awal -->
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".". "<br><br>";
?>

<!-- 3.1.1 Menambah 5 data baru array -->
<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Mango", "Orange", "Pineapple", "Strawberry");

echo "Data buah: <br>";
print_r($fruits);

echo "<br><br>Nilai dengan indeks tertinggi: " . end($fruits);
echo "<br>Indeks tertinggi dari array: " . (count($fruits) - 1) . "<br><br>";
?>

<!-- 3.1.2 Menghapus data -->
<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Mango", "Orange", "Pineapple", "Strawberry");

unset($fruits[4]); 

echo "Data setelah Mango dihapus:<br>";
print_r($fruits);

echo "<br><br>Nilai dengan indeks tertinggi sekarang: " . end($fruits);
echo "<br>Indeks tertinggi dari array: " . max(array_keys($fruits)) . "<br><br>";
?>

<!-- 3.1.3 Membuat array baru -->
<?php
$veggies = array("Carrot", "Broccoli", "Spinach");

echo "Data sayuran: <br>";
foreach ($veggies as $v) {
    echo $v . "<br>";
}
?>