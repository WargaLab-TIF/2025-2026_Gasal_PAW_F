<?php
    $fruits = array("Avocad", "Blueberry", "Cherry");
    $arrlenght = count($fruits);

    for($x = 0; $x < $arrlenght; $x++) {
        echo $fruits[$x];
        echo "<br>";
    };

    echo "<br><br>";
    $buah_baru = array("Apel", "Belimbing", "Mangga", "Nanas", "Pisang");

    for($i = 0; $i < count($buah_baru); $i++) {
        array_push($fruits, $buah_baru[$i]);
    };
    echo count($fruits) . "<br>";

    echo "<br><br>";
    $veggies = array("Brokoli", "Selada", "Tomat");
    $arrlenght = count($veggies);

    for($x = 0; $x < $arrlenght; $x++) {
        echo $veggies[$x];
        echo "<br>";
    };
?>