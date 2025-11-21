<?php

    $fruits = array("Avocado", "Blueberry", "Cherry");
    echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".";

    echo "<br>"; 
    // 3.1.1
    // Tambah 5 data baru dalam array
    array_push ($fruits, "Melon", "Lemon", "Durian", "Kiwi", "Mango");

    echo "<br>"; 
    // Tampilkan nilai dengan indeks tertinggi dari array $fruits!
    echo 'nilai dengan indeks tertinggi dari array $fruits!: ' .$fruits[count($fruits)-1];

    echo "<br>"; 
    //indeks tertinggi
    echo 'indeks tertinggi dari array $fruits: ' . (count($fruits)-1);

    echo "<br>" . "<br>"; 
    // 3.1.2
    // Hapus 1 data tertentu dari array $fruits
    array_pop($fruits);

    // Tampilkan nilai dengan indeks tertinggi dari array $fruits!
    echo 'nilai dengan indeks tertinggi dari array $fruits! setelah hapus 1 data: ' .$fruits[count($fruits)-1];

    echo '<br> indeks tertinggi dari array $fruits setelah hapus 1 data: ' . (count($fruits)-1);

    echo "<br>" . "<br>"; 
    //3.1.3
    $veggies = array("Wortel", "Kubis", "Jagung");
    // Tampilkan seluruh data dari array $veggies
    var_dump ($veggies);

?>