<?php
    $fruits = array("Avocado","Blueberry","Cherry");
    array_push($fruits,"Mango","Apple","Banana","Grape","Strawberry");

    echo " <b>3.1. Implementasi</b> <br> ";
    echo "i like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".";
    echo "<br><br>";

    echo "<b>3.1.1. Tampilan setelah di tambah data </b> <br>";
    print_r($fruits);

    echo "<br><br>";
    echo "<b>Tampilan nilai tertinggi indeks</b> <br>";
    echo "nilai indeks tertinggi nya adalah " . end($fruits);

    echo "<br><br>";
    echo "<b>3.1.2. Hapus data indeks array</b>";
    unset($fruits[6]);

    echo "<br>";
    echo "<b>Tampilan nilai dengan indeks tertinggi</b><br>";
    echo "nilai Indeks tertingginya tetap yaitu " . end($fruits); 
    echo "<br><br> contoh hapus";
    echo "karena yang saya hapus indeks ke-6 " . var_dump($fruits[6]);

    echo "<br><br>";
    echo "<b>3.1.3. Array baru dengan 3 buah data</b><br>";
    $veggies = array("Makan","Kerja","Tidur");
    print_r($veggies);
?>