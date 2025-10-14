<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modul 3 - Array Asosiatif</title>
</head>
<body>
<?php
    echo '<h3>3.4 Mengakses array asosiatif dengan perulangan menggunakan struktur perulangan (loop)</h3>';

    $height = [
        "Andy" => "176",
        "Barry" => "165",
        "Charlie" => "170"
    ];

    // Menampilkan data awal
    foreach ($height as $x => $x_value) {
        echo "Key - $x, Value - $x_value<br>";
    }

    echo '<h4>3.4.1 Tambah data menggunakan FOREACH</h4>';

    $new = [
        "Aini" => "160",
        "Erik" => "173",
        "Ryan" => "162",
        "Lena" => "165",
        "Nia"  => "164"
    ];

    // Gabungkan array lama dan baru
    $height = array_merge($height, $new);


    foreach ($height as $x => $x_value) {
        echo "Key - $x, Value - $x_value<br>";
    }

    // Tidak perlu ubah struktur foreach karena otomatis membaca semua elemen array

    echo '<h4>3.4.2 Menampilkan array asosiatif dengan FOR</h4>';

    $weight = [
        "Andy" => "68",
        "Barry" => "59",
        "Charlie" => "63"
    ];


    foreach ($weight as $w => $w_value) {
        echo "Key - $w, Value - $w_value<br>";
    }

    // Tidak perlu buat skrip baru, cukup ubah variabel menjadi $weight
?>
</body>
</html>
