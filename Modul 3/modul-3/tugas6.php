<?php
    echo "3.6.1 <br>";
    echo 'implementasi fungsi array_push() untuk Menambah data ke array multidimensi<br> ';
    $students = [
        ["Alex", "220401", "0812345678"],
        ["Bianca", "220402", "0812345687"]
    ];

    array_push($students, ["Candice", "220403", "0812345665"]);
    print_r($students);
    echo "<br> <br> <br>";

    

    echo "3.6.2 <br>";
    echo 'implementasi fungsi array_merge() untuk menimpa data yang sudah ada <br> ';
    $a = ["nama" => "Farrel", "umur" => 20];
    $b = ["umur" => 19, "jurusan" => "Informatika"];

    $hasil = array_merge($a, $b);
    print_r($hasil);
    echo "<br> <br> <br>";



    echo "3.6.3 <br>";
    echo 'implementasi fungsi array_values() untuk Menghapus “lubang” pada array setelah unset() <br> ';
    $angka = [10, 20, 30, 40];
    unset($angka[1]);

    echo "sebelum : ";
    print_r($angka);
    echo "<br>";

    echo "sesudah : ";
    $angka = array_values($angka);
    print_r($angka);
    echo "<br> <br> <br>";




    echo "3.6.4 <br>";
    echo 'implementasi fungsi array_search() untuk Mengecek apakah suatu nilai ada di array <br> ';
    $warna = ["farrel", "aldi", "dodit"];

    if (array_search("aldi", $warna) !== false) {
        echo "nama ditemukan!";
    } else {
        echo "nama tidak ada!";
    }
    echo "<br> <br> <br>";





    echo "3.6.5 <br>";
    echo 'implementasi fungsi array_flter() untuk Menghapus nilai kosong atau null: <br> ';
    $data = ["Farrel", "", null, "Bianca", 0, "Candice"];
    $hasil = array_filter($data);
    print_r($hasil);
    echo "<br> <br> <br>";



    echo "3.6.6 <br>";
    echo 'Implementasi berbagai fungsi sorting pada array <br> ';
    echo "a. sort() — Mengurutkan array secara menaik (ascending) berdasarkan nilai: <br> ";
    $angka = [40, 10, 50, 20, 30];
    sort($angka);
    print_r($angka);
    echo "<br> <br>";


    echo "b. rsort() — Mengurutkan array secara menurun (descending) berdasarkan nilai: <br>";
    $angka = [40, 10, 50, 20, 30];
    rsort($angka);
    print_r($angka);
    echo "<br> <br>";


    echo "c. asort() — Mengurutkan array asosiatif berdasarkan nilai, tapi mempertahankan key: <br>";
    $buah = [
        "apel" => 5000,
        "pisang" => 3000,
        "mangga" => 7000,
        "jeruk" => 4000
    ];
    asort($buah);
    print_r($buah);
    echo "<br> <br>";


    echo "d. arsort() — Mengurutkan array asosiatif secara menurun berdasarkan nilai: <br>";
    $buah = [
        "apel" => 5000,
        "pisang" => 3000,
        "mangga" => 7000,
        "jeruk" => 4000
    ];
    arsort($buah);
    print_r($buah);
    echo "<br> <br>";


    echo "e. ksort() — Mengurutkan array asosiatif berdasarkan key (naik / ascending): <br>";
    $buah = [
        "mangga" => 7000,
        "apel" => 5000,
        "pisang" => 3000,
        "jeruk" => 4000
    ];
    ksort($buah);
    print_r($buah);
    echo "<br> <br>";


    echo "f. krsort() — Mengurutkan array asosiatif berdasarkan key (turun / descending): <br>";
    $buah = [
        "mangga" => 7000,
        "apel" => 5000,
        "pisang" => 3000,
        "jeruk" => 4000
    ];
    krsort($buah);
    print_r($buah);
    echo "<br> <br>";


    echo "g. usort() — Mengurutkan array menggunakan fungsi kustom (custom function): <br>";
    $angka = [10, 20, 30, 40, 50];

    usort($angka, function($a, $b) {
        return ($a % 3) <=> ($b % 3);
    });
    print_r($angka);














    