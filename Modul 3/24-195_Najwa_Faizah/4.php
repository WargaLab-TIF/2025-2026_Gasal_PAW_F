<?php
    $height = array("Andy" =>"176", "Barry" => "165", "Charlie" => "170");

    foreach($height as $x => $x_value){
        echo "key=".$x." value=".$x_value;
        echo "<br>";
    }
    echo"<br>";

    // 3.4.1. Tambahkan 5 data baru
    $height["Najwa"] = 160;
    $height["Yongky"] = 172;
    $height["Brintik"] = 177;
    $height["Fajar"] = 158;
    $height["Hani"] = 169;
    foreach($height as $x => $x_value){
        echo "key=".$x." value=".$x_value;
        echo "<br>";
    }
    echo"<br>";
    // Apakah Anda perlu
    // melakukan perubahan pada skrip penggunaan struktur perulangan FOR
    // (skrip baris 4 – 7) untuk menampilkan seluruh data dalam array $height
    // dengan adanya penambahan 5 data baru? Mengapa demikian? Jelaskan!
    // Tidak perlu diubah, karena foreach otomatis membaca semua elemen array termasuk data baru, tanpa perlu menentukan batas pengulangan

    // 3.4.2. Buat array baru dengan nama $weight yang memiliki 3 buah data!
    $weight = array("Najwa" => "43", "Yongky" => "57", "Brintik" => "46");
    foreach($weight as $x => $x_value){
        echo "key=".$x." value=".$x_value;
        echo "<br>";
    }
    // Apakah Anda membuat skrip baru untuk menampilkan
    // seluruh array $weight ataukah Anda cukup sedikit memodifikasi skrip yang
    // sudah ada? Mengapa demikian? Jelaskan!
    // Tidak membuat skrip baru, hanya mengganti nama array menjadi $weight, karena struktur foreach bisa digunakan untuk semua array.
?>