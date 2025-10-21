<?php
    $Hero = ["Teo", "Yeonhee", "Kyle"];
    print_r($Hero);
    echo "<br>";
    
    array_push($Hero, "Rudy", "Kris");
    print_r($Hero);
    echo "<br>";

    $Type = ["Physic", "Magic", "Defense"];
    $Combine = array_merge($Hero,$Type);
    print_r($Combine);
    echo "<br>";

    $Atribut = [
        "Physic" => "Sword",
        "Magic"  => "Wand",
        "Defense"=> "Shield"
    ];
    $Nilai = array_values($Atribut);
    print_r($Nilai);
    echo "<br>";

    $Search = array_search('Wand',$Atribut);
    echo "Wand adalah atribut dari $Search";
    echo "<br>";

    $Angka = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $Genap = array_filter($Angka, function($n) {
        return $n % 2 == 0;
    });
    print_r($Genap);
    echo "<br>";

    $Angkaa = [22, 44, 33, 55, 11];
    sort($Angkaa);
    print_r($Angkaa);
    echo "<br>";

    rsort($Angkaa);
    print_r($Angkaa);
    echo "<br>";

    $Fruit = [
        "Mangga" => 8000,
        "Cherry"=> 9000,
        "Alpukat"=> 7000
    ];
    asort($Fruit);
    print_r($Fruit);
    echo "<br>";

    ksort($Fruit);
    print_r($Fruit);
?>