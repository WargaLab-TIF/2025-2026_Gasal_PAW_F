<?php
    $height = array("Andy" =>"176", "Barry" => "165", "Charlie" => "170");
    echo "Andy is".$height['Andy']."cm tall.";

    echo "<br><br>";

    // 3. 3. 1. Tambahkan 5 data baru dalam array $height! Tampilkan nilai dengan 
    // indeks terakhir dari array $height!
    $height["Najwa"] = 160;
    $height["Yongky"] = 172;
    $height["Brintik"] = 177;
    $height["Fajar"] = 158;
    $height["Hani"] = 169;
    echo "indeks terakhir dari array adalah: ".$height["Hani"]."cm. <br>";

    // 3.3.2. Hapus 1 data tertentu dari array $height! Tampilkan nilai dengan indeks 
    // terakhir dari array $height!
    array_pop($height);
    echo "indeks terakhir dari array: ".$height["Fajar"]."cm. <br>";

    // 3.3.3. Buat array baru dengan nama $weight yang memiliki 3 buah data!
    $weight = array("Najwa" => "43", "Yongky" => "57", "Brintik" => "46");
    echo "Berat Yongky: ".$weight["Yongky"]."kg";

?>