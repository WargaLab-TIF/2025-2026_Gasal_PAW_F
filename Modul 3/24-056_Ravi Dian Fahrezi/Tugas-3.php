<?php
    $height = array(
        "Andy" => "176",
        "Barry" => "165",
        "Charlie" => "170"
    );
    echo "Andy is " . $height["Andy"] . " cm tall";

    //3.3.1 menambahkan 5 data
    $height += array(
        "Ravi" => "176",
        "Rayyan" => "175",
        "Raihan" => "181",
        "Yusril" => "187",
        'Tanata' => "167"
    );
    echo "<br><br>";
    echo "<b> 3.3.1 </b><br>";
    print_r($height);
    echo "<br>";
    echo array_key_last($height);
    
    //3.3.2 menghapus 1 data
    unset($height["Yusril"]);
    echo "<br><br>";
    echo "<b> 3.3.2 </b><br>";
    print_r($height);
    echo "<br>";
    echo array_key_last($height);

    //3.3.3 membuat array baru
    $weight = array(
        "Rayyan" => "80",
        "Rendi" => "90",
        "Petj" => "65",
    );
    echo "<br><br>";
    echo "<b> 3.3.1 </b><br>";
    $keys = array_keys($weight);
    $values = array_values($weight);
    echo $keys[1] . " = " . $values[1];
?>