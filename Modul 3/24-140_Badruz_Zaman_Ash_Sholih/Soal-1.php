<?php
    $fruits = array("Avocado", "Blueberry", "Cherry");
    echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".";
    echo "<br>";
    
    array_push($fruits, "Delima", "Jeruk", "Kiwi", "Leci", "Manggis");
    echo $fruits[7];
    echo "<br>";
    
    unset($fruits[7]);
    echo $fruits[6];
    echo "<br>";

    $veggies = ["Brokoli", "Wortel", "Sawi"];
    echo $veggies[0] . ", " . $veggies[1] . ", " . $veggies[2];
?>