<?php
    // 3. 6. 1. Implementasi fungsi array_push()!
    $warna = array("pink","hitam");
    array_push($warna,"biru","kuning");
    echo "array_push: ";
    print_r($warna);
    echo "<br><br>";

    // 3.6.2. Implementasi fungsi array_merge()!
    $buah1=array("apel","jeruk");
    $buah2=array("mangga","pisang");
    echo "array_merge: ";
    print_r(array_merge($buah1,$buah2));
    echo "<br><br>";

    // 3.6.3. Implementasi fungsi array_values()!
    $a=array("Nama" => "Najwa", "Usia" => "20", "Prodi" => "Teknik Infor");
    echo "array_values: ";
    print_r(array_values($a));
    echo "<br><br>";

    // 3.6.4. Implementasi fungsi array_search()!
    $a=array("a" => "apel", "b" => "jeruk", "c" => "mangga");
    echo "array_search: ".array_search("jeruk",$a);
    echo "<br><br>";
    
    // 3.6.5. Implementasi fungsi array_filter()!
    function cek_ganjil($angka) {
        return ($angka % 2 == 1);
    }
    $angka = array(1, 2, 3, 4, 5);
    $hasil = array_filter($angka, "cek_ganjil");
   
    echo "Angka ganjil: ";
    print_r($hasil);
    echo "<br><br>";

    // 3.6.6. Implementasi berbagai fungsi sorting pada array!
    $angka = array(5, 2, 8, 1, 9);
    sort($angka);
    echo "Hasil sort() (kecil ke besar): ";
    print_r($angka);
    echo "<br>";

    rsort($angka);
    echo "Hasil rsort() (besar ke kecil): ";
    print_r($angka);
    echo "<br>";

    $nilai = array("Najwa" => 80, "Yongky" => 75, "Brintik" => 90);
    asort($nilai);
    echo "Hasil asort() (nilai kecil ke besar): ";
    print_r($nilai);
    echo "<br>";

    ksort($nilai);
    echo "Hasil ksort() (nilai besar ke kecil): ";
    print_r($nilai);
    echo "<br>";

?>