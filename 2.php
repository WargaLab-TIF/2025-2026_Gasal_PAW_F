<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

    $fruits = array("Avocado", "Blueberry", "Cherry");
    $arrlenght = count($fruits);

    for($x = 0; $x < $arrlenght; $x++){
        echo $fruits[$x] ;
        echo "<br>";
    }
    $y = ["Apple", "Pineapple", "Banana", "DragonFruit", "Mango"];
    for($p = 0; $p < 5;$p++){
        array_push($fruits, $y[$p]);
    }
        echo "<br><br>";

    echo "Panjang Jumlah Data pada array fruit adalah = " . (count($fruits) - 1);

        echo "<br><br>";

?>

<?php
$veggies = ["Cabbage", "Carrot", "Lettuce"];
$veggieslenght = count($veggies);

for($i = 0; $i < $veggieslenght;$i++){
    echo "<br>" . $veggies[$i];
}




?>


</body>
</html>