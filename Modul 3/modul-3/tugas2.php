<?php
    echo "3.2.1";
    echo "<br>";
    $fruit = array("avocado", "bluebery", "cherry");
    $newfruit = array("watermelon", "banana", "grapes", "melon", "guava");
    $arrlength = count($fruit);

    for($x=0; $x < count($newfruit); $x++){
        array_push($fruit, $newfruit[$x]);
    }
    echo "panjang array setelah melakukan penambahan 5 data adalah : ". count($fruit);
    echo "<br>";
    echo "<br>";

    echo "menampilah semua data pada array saat ini : <br>";
    for($x=0; $x < count($fruit); $x++){
        echo $fruit[$x];
        echo "<br>";
    }
    echo "<br> <br> <br>";


    


    echo "3.2.2";
    echo "<br>";
    $veggies = array("carrot", "mustard", "spinach");
    $arrlength = count($veggies);

    for($x=0; $x < $arrlength; $x++){
        echo $veggies[$x];
        echo "<br>";
    }