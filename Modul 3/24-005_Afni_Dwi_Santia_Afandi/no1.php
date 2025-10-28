<?php
$fruits = array("avocado","Blueberry","Cherry");
echo "<br>";
echo "i like ". $fruits[0]. ", ". $fruits[1] . "And " . $fruits[2]. ".";

/* == Jawaban 3.1.1 == */
// tambah data baru
$fruits[] = "Orange";
$fruits[] = "Mango";
$fruits[] = "Blueberry";
$fruits[] = "Banana";
$fruits[] = "Apple";

// indeks tertinggi
$indeks_tertinggi = count($fruits) - 1;

// tampilkan nilai dengan indeks tertinggi
echo "<br>";
echo "Indeks tertinggi: " . $indeks_tertinggi . "<br>";
echo "Nilai pada indeks tertinggi: " . $fruits[$indeks_tertinggi];

/* == Jawaban 3.1.2 == */
// hapus satu data 
unset($fruits[1]);

// indeks tertinggi
$indeks_tertinggi = count($fruits) - 1;

// tampilkan nilai dengan indeks tertinggi
echo "<br>";
echo "Indeks tertinggi: " . $indeks_tertinggi . "<br>";
echo "Nilai pada indeks tertinggi: " . $fruits[$indeks_tertinggi];

/* == Jawaban 3.1.3 == */
echo "<br>";
$veggies = array("Tomato", "Brocoli", "Cucumber");
foreach ($veggies as $x) {
  echo "$x <br>";
}
?>