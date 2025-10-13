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
    echo "Andy is " . $height['Andy'] . " cm tall.";
    echo "<br>";
    
    echo $height['Harris'];
    echo "<br>";
    
    unset($height['Harris']);
    echo $height['Gala'];
    echo "<br>";

    $weight = [
        "Andy"   => "55",
        "Barry"  => "65",
        "Charlie"=> "60"
    ];
    echo $weight['Barry'];
?>