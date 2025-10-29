<?php
    $fruits = array("Avocad", "Blueberry", "Cherry");
    echo "I Like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".";
    echo "<br><br>";

    // 3.1.1 Menambahkan Data
    echo "<b>3.1.1</b> <br>";
    array_push($fruits, "Apel", "Pisang", "Nanas", "Semangka", "Mangga");
    print_r($fruits);
    echo "<br>" . $fruits[max(array_keys($fruits))] . "<br>";
    echo max(array_keys($fruits)) . "<br><br>";

    //3.1.2 Hapus Data
    echo "<b>3.1.2</b> <br>";
    unset($fruits[5]);
    print_r($fruits);
    echo "<br>" . $fruits[max(array_keys($fruits))] . "<br>";
    echo max(array_keys($fruits)) . "<br><br>";

    //3.1.3 Membuat Array
    echo "<b>3.1.3</b> <br>";
    $veggies = array("Wortel", "Selada", "Kol");
    print_r($veggies)
?>