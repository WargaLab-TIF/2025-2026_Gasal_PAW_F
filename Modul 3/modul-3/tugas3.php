<?php
    echo "3.3.1 <br>";
    $height = array("andy" => "176", "bany" => "165", "charlie" => "170");
    $data_tambah = ["slamet" => "180", "supri" => "172", "jaenal" => "156", "bahlil" => "162", "maul" => "170"];
    $height = array_merge($height, $data_tambah);
    echo "nilai dengan index terakhir setelah ditambahkan 5 data baru pada array adalah : ";
    echo array_key_last($height)." => ". end($height)."<br> <br> <br>";




    echo "3.3.2 <br>";
    array_pop($height);
    echo "nilai dengan index terakhir setelah penghapusan data pada array adalah : ";
    echo array_key_last($height)." => ". end($height)."<br> <br> <br>";

    


    echo "3.3.3 <br>";
    $weigh = array("aldi" => "55", "arya" => "60", "arip" => "70");
    $kunci = array_keys($weigh);
    echo 'array ke-2 dari array $weight adalah : ';
    echo $kunci[1]." is ".$weigh["arya"]." kg";
