<?php
    $fruits = array("Avocado", "Blueberry", "Cherry");
    $arrlength = count($fruits);

    for($x = 0; $x < $arrlength; $x++){
        echo $fruits[$x];
        echo "<br>";
    }

    // 3.2.1
    // Tambahkan 5 data baru dalam array $fruits menggunakan perulangan FOR
    echo "<br>";
    $new_fruits = array("Melon", "Lemon", "Durian", "Kiwi", "Mango");

    for ($i = 0; $i < count($new_fruits); $i++) {
        $fruits[] = $new_fruits[$i];
    }

    $arrlength = count($fruits);
    for($x = 0; $x < $arrlength; $x++){
        echo $fruits[$x];
        echo "<br>";
    }

    echo '<br>panjang (jumlah data) array $fruits saat ini? ' .(count($fruits));
    

    echo "<br>"."<br>";
    //3.2.2
    $veggies = array("Wortel", "Kubis", "Jagung");
    $arrlength2 = count($veggies);
    
    for($y = 0; $y < $arrlength2; $y++){
        echo $veggies[$y];
        echo "<br>";
    }
?>