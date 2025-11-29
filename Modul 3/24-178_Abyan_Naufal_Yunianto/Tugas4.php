<?php
    echo "<b>3.4 akses array implementasi</b> <br>";
    $height = ["Andy"=>"176","Barry"=>"165","Charlie"=>"170"];
    foreach($height as $x => $x_value) {
        echo "Key-" . $x . ", Value-" . $x_value;
        echo "<br>";
    };
    echo "<br><br>";
    echo "<b>3.4.1. tambah 5 data baru dalam array</b> <br>";
    $baru = [
        "Mada"=>"180",
        "Salah"=>"179",
        "Kabib"=>"181",
        "Luffy"=>"165",
        "Sanji"=>"190",
    ];
    $gabung = $height + $baru;
    foreach($gabung as $x => $x_value) {
        echo "Key-" . $x . ", Value-" . $x_value;
        echo "<br>";
    };
    echo "<br>";
    echo "saya rubah hanya pada variabel yang semulanya height menjadi variabel gabung, karena disitu merupakan gabungan dari array lama dan barunya.";
    echo "<br>";
    echo "<b>3.4.2. buat array baru</b> <br>";
    $weight = [
        "Andy"=>"60",
        "Luffy"=>"56",
        "Sanji"=>"65",
    ];
    foreach($weight as $x => $x_value) {
        echo "Key-" . $x . ", Value-" . $x_value;
        echo "<br>";
    };
    echo "<br>";
    echo "saya salin dan tempel skrip foreach dan saya rubah hanya pada variabel yang menyimpan arraynya saja.";
?>