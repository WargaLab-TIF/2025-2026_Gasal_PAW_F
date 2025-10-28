<?php
/* == Jawaban 3.6.1 == */
$fruits = array("Apel", "Jeruk", "Mangga");
array_push($fruits, "Pisang", "Semangka");

foreach ($fruits as $f) {
    echo $f . "<br>";
}

/* == Jawaban 3.6.2 == */
$fruits1 = array("Apel", "Jeruk");
$fruits2 = array("Mangga", "Pisang");

$gabung = array_merge($fruits1, $fruits2);

foreach ($gabung as $f) {
    echo $f . "<br>";
}

/* == Jawaban 3.6.3 == */
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
$nilai = array_values($height);

for ($i = 0; $i < count($nilai); $i++) {
    echo $nilai[$i] . "<br>";
}

/* == Jawaban 3.6.4 == */
$fruits = array("Apel", "Jeruk", "Mangga");
$cari = array_search("Jeruk", $fruits);

echo "Jeruk ada di indeks ke-" . $cari;

/* == Jawaban 3.6.5 == */
$angka = array(10, 5, 20, 3, 15);
$hasil = array_filter($angka, function($n) {
    return $n > 10;
});

foreach ($hasil as $h) {
    echo $h . "<br>";
}

/* == Jawaban 3.6.6 == */
$angka = array(5, 1, 9, 3, 7);

sort($angka); // urut naik
echo "Urut naik:<br>";
foreach ($angka as $a) {
    echo $a . " ";
}

echo "<br><br>";

rsort($angka); // urut turun
echo "Urut turun:<br>";
foreach ($angka as $a) {
    echo $a . " ";
}
?>
