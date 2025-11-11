<?php
    $fruits = array("Avocado", "Blueberry", "Cherry");

    // Menambahkan 5 data baru
    array_push($fruits, "Durian", "Anggur", "Apel", "Pepaya", "Mangga");

    // Menampilkan seluruh array fruits
    echo "I like ";
    foreach($fruits as $fruit) {
        echo $fruit . ", ";
    }
    echo "<br>";

    // Menampilkan nilai dengan indeks tertinggi dari array $fruits
    echo "Data pada indeks tertinggi: " . $fruits[count($fruits)-1] . "<br>";
    echo "Indeks tertinggi dari array fruits: " . (count($fruits)-1) . "<br>";

    // Menghapus elemen
    unset($fruits[2]);
    echo "<br>";
    echo "Setelah menghapus elemen ketiga:<br>";
    foreach($fruits as $fruit) {
        echo $fruit . ", ";
    }
    echo "<br>";

    echo "Data pada indeks tertinggi: " . $fruits[count($fruits)-1] . "<br>";
    echo "Indeks tertinggi dari array fruits setelah penghapusan: " . (count($fruits)-1) . "<br>";

    //Menambahkan array baru
    echo "<br>";
    $veggies = array("Nangka", "Nanas", "Jeruk");

    echo "Data dari array veggies: <br>";
    foreach($veggies as $veggie) {
        echo $veggie. ",";
    }

?>






