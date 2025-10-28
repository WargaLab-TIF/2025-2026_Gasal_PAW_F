<?php
$angka = array(10, 25, 30, 45, 50, 55, 60);

echo "Hasil sebelum array_filter(): <br>";
var_dump($angka);
echo "<br><br>";

$hasil = array_filter($angka, function($nilai) {
    return $nilai > 40;
});

echo "Hasil setelah array_filter() yaitu angka diatas 40: <br>";
var_dump($hasil);
?>
