<?php
    echo "<b>Implementasi 3.3. </b><br>";
    $height = [
        "Andy"=>"176",
        "Barry"=>"165",
        "Charlie"=>"170"
    ];
    echo "Andy is " . $height["Andy"] . "cm tall";

    echo "<br><br>";
    echo "<b>3.3.1. tambah data baru</b><br>";
    $baru = [
        "Mada"=>"180",
        "Salah"=>"179",
        "Kabib"=>"181",
        "Luffy"=>"165",
        "Sanji"=>"190",
    ];
    $gabung = $height + $baru;

    print_r($gabung);

    echo "<br>";
    echo "Indeks terakhir " . end($gabung) ;

    echo "<br><br>";
    echo "<b>3.3.2. hapus 1 data tertentu</b><br>";
    unset($gabung["Luffy"]);
    echo "Indeks terakhir " . end($gabung) ;

    echo "<br><br>";
    echo "<b>3.3.3. buat array baru</b><br>";
    $weight = [
        "Andy"=>"60",
        "Luffy"=>"56",
        "Sanji"=>"65",
    ];
    var_dump($weight["Luffy"]);
?>