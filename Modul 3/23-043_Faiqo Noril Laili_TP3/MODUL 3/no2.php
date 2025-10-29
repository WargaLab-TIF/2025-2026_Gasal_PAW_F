<?php

    $fruits = array("Avocado", "Blueberry", "Cherry");

    $newFruits = array("Durian", "Anggur", "Apel", "Pepaya", "Mangga");
    for($i = 0; $i < count($newFruits); $i++){
        $fruits[] = $newFruits[$i]; 
    }

    $arrLength = count($fruits);
    for($x = 0; $x < $arrLength; $x++){
        echo $fruits[$x];
        echo "<br>";
    }

    echo "Jumlah data dalam array fruits saat ini: " . $arrLength . "<br>";

    echo "<br>";
    $veggies = array("Nangka", "Nanas", "Jeruk");

    $veggiesLength = count($veggies);
    for($x = 0; $x < $veggiesLength; $x++){
        echo $veggies[$x];
        echo "<br>";
    }
?>
