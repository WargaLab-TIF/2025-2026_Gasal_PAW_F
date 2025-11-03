<?php
    echo "<b>3.2. Implementasi</b><br>";
    $fruits = array("Avocado","Blueberry","Cherry");
    $arrlength = count($fruits);

    for($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }
    echo "<br><br>";
    echo "<b>3.2.1. Tambah 5 data baru pakai for</b><br>";
    $fruits = array("Avocado","Blueberry","Cherry");
    $buahbaru = array("Apple","Mango","Lecy","Banana","Grape");
    $pnjngbr = count($buahbaru);
    
    for($i = 0; $i < $pnjngbr; $i++) {
        $fruits[] = $buahbaru[$i];
    }
    $arrlength = count($fruits);
    
    for($y = 0; $y < $arrlength; $y++) {
        echo $fruits[$y];
        echo "<br>";
    }
    echo "<br>";
    echo "jumlah panjang data sekarang $arrlength <br>";
    echo "saya rubah karena saya perlu untuk membuat perulangan untuk memasukkan data baru ke dalam array fruits, dan perulangan untuk menampilkan semua data arraynya. ";
    
    echo "<br><br>";
    echo "<b>3.2.2. buat array baru memakai for</b><br>";
    $veggies = ["Avocado","Blueberry","Cherry"];

    for ($e = 0; $e < count($veggies); $e++) {
        echo $veggies[$e];
        echo "<br>";
    }
    echo "<br>";
    echo "ya, saya memodifikasi sedikit seperti nama arraynya, nama perulangannya, dan isi data arraynya. karena cuma untuk memperlihatkan data jadi saya copas yang sudah saya kerjakan sebelumnya. <br>"

?>