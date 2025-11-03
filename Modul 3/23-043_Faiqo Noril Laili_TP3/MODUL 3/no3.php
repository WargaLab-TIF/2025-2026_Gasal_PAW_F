<?php
    $height = array(
        "andy" => "176",
        "Barry" => "165",
        "charlie" => "170"
    );

    // Menambahkan 5 data baru
    $height["Faiqo"] = "180";
    $height["Noril"] = "169";
    $height["Laili"] = "160";
    $height["April"] = "175";
    $height["Dinda"] = "172";

    foreach($height as $x => $x_value) {
        echo  $x . ", value=" . $x_value;
        echo "<br>";
    }
    // Menampilkan nilai dengan indeks terakhir
    $lastKey = array_key_last($height);
    echo "$lastKey is " . $height[$lastKey] . "cm tall<br>";

    echo "<br>";
    $height = array(
        "andy" => "176",
        "Barry" => "165",
        "charlie" => "170",
        "Faiqo" => "180",
        "Noril" => "169",
        "Laili" => "160",
        "April" => "175",
        "Dinda" => "172"
    );


    unset($height["David"]);
    foreach($height as $x => $x_value) {
        echo  $x . ", value=" . $x_value;
        echo "<br>";
    }
    $lastKey = array_key_last($height);
    echo "$lastKey is " . $height[$lastKey] . "cm tall<br>";

    echo "<br>";
    $weight = array("andy" => "70", "Barry" => "65", "charlie" => "68");

    // Menampilkan data ke-2 dari array $weight
    $keys = array_keys($weight);  
    echo "Data ke-2 dari array \$weight: " . $weight[$keys[1]] . "kg<br>";
?>

