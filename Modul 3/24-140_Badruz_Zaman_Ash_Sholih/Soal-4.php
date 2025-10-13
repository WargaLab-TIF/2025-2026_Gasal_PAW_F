<?php
    $height = array(
        "Andy"    => "176",
        "Barry"   => "165",
        "Charlie" => "170",
        "Daniel"  => "175",
        "Edward"  => "180",
        "Fauzan"  => "182",
        "Gala"    => "183",
        "Harris"  => "177"
    );

    $weight = [
        "Andy"   => "55",
        "Barry"  => "65",
        "Charlie"=> "60"
    ];

    foreach($weight as $x => $x_value) {
        echo "Key-" . $x . ", Value-" . $x_value;
        echo "<br>";
    }
?>