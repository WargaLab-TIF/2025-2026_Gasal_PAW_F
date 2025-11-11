<?php
    $height = array(
        "andy" => "176",
        "Barry" => "165",
        "charlie" => "170"
    );

    // Menambahkan 5 data baru
    $height["David"] = "180";
    $height["Edward"] = "169";
    $height["Fiona"] = "160";
    $height["George"] = "175";
    $height["Helen"] = "172";

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
        "David" => "180",
        "Edward" => "169",
        "Fiona" => "160",
        "George" => "175",
        "Helen" => "172"
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

