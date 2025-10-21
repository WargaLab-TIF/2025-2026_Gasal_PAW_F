<?php
    $fruits = array("Avocado", "Blueberry", "Cherry");
    echo "I like ". $fruits[0].", ".$fruits[1]. " and ".$fruits[2].".";
    echo"<br><br>";

    // 3.1.1 Tambah 5 data baru
    array_push($fruits, "Durian", "Guava", "Lemon", "Manggo", "Banana");
    echo "Data baru: ";
    print_r($fruits);

    echo "<br> Nilai indeks tertinggi: ".$fruits[count($fruits)-1];
    echo "<br> Indeks tertinggi: ".(count($fruits)-1);
    echo "<br><br>";

    // 3.1.2 Hapus 1 data
    array_pop($fruits);
    print_r($fruits);

    echo "<br>Nilai indeks tertinggi sekarang: ".$fruits[count($fruits)-1];
    echo "<br> Indeks tertinggi sekarang: ".(count($fruits)-1);

    // 3.1.3 Array baru
    $veggies = array("Tomat", "Wortel", "Sawi");
    echo "<br><br>Hasil veggies: <br>";
    print_r($veggies);

?>