<?php
    $height = array(
        "Andy" => "176",
        "Barry" => "165",
        "Charlie" => "170"
    );

    foreach($height as $x => $x_value) {
        echo "Key-" . $x . ", Value-" . $x_value;
        echo "<br>";
    }

    // 3.4.1 menambahkan 5 data 
    echo "<br><b>3.4.1</b><br>";
    $height += array(
        "Ravi" => "176",
        "Rayyan" => "175",
        "Raihan" => "181",
        "Yusril" => "187",
        'Tanata' => "167"
    );
    foreach($height as $x => $x_value) {
        echo "Key-" . $x . ", Value-" . $x_value;
        echo "<br>";
    }

    // 3.4.2 membuat array baru
    echo "<br><b>3.4.1</b><br>";
    $weight = array(
        "Rayyan" => "80",
        "Rendi" => "90",
        "Petj" => "65",
    );
    foreach($weight as $x => $x_value) {
        echo "Key-" . $x . ", Value-" . $x_value;
        echo "<br>";
    }
?>