<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

    $fruits = ["Avocado", "Blueberry", "Cherry" ];

    echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . "." ;

    array_push(  $fruits ,"Orange" , "Pineaple" , "Apple" , "Melon" , "Watermelon") ;

    echo "Indeks Tertinggi dari array Fruit adalah  " . (count($fruits) - 1) ;

    echo "<br><br>";
    unset($fruits[1]);


    echo "Indeks Tertinggi dari array Fruit adalah  " . (count($fruits) - 1) ;

    echo "<br><br>";

    $veggies = ["Cabbage", "Carrot", "Lettuce"];

    foreach($veggies as $v){
        echo "$v " ;
    }
?>



</body>
</html>