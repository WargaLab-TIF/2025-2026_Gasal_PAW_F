<?php
    $fruits = array("Avocad", "Blueberry", "Cherry");
    $arrlenght = count($fruits);

    for($x = 0; $x < $arrlenght; $x++) {
        echo $fruits[$x];
        echo "<br>";
    };

    //3.2.1 menambahkan 5 data
    echo "<br> <b>3.2.1</b> <br>";
    $buah_baru = array("Apel", "Mangga", "pisang", "Nanas", "Durian");

    for($i = 0; $i < count($buah_baru); $i++) {
        array_push($fruits, $buah_baru[$i]);
    };
    echo count($fruits) . "<br>";

    //3.2.2 membuat array baru
    echo "<br><b>3.2.2</b> <br>";
    $veggies = array("Wortel", "Selada", "Kol");
    $arrlenght = count($veggies);

    for($x = 0; $x < $arrlenght; $x++) {
        echo $veggies[$x];
        echo "<br>";
    };
?>
