<?php
    $fruits = array("Avocado", "Blueberry", "Cherry", "Delima", "Jeruk", "Kiwi", "Leci", "Manggis");
    $veggies = ["Brokoli", "Wortel", "Sawi"];
    $arrlength = count($veggies);
    
    for($x = 0; $x < $arrlength; $x++) {
        echo $veggies[$x];
        echo "<br>";
    }
?>