<?php
    $fruits = array("Avocado", "Blueberry", "Cherry");
    $arrlength = count($fruits);

    for($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }

    // 3.2.1 Tambah 5 data baru
    array_push($fruits, "Durian", "Guava", "Lemon", "Manggo", "Banana");

    echo "<br> Panjang array fruits: <br>";
    for ($i = 0; $i < count($fruits); $i++){
        echo $fruits[$i]. "<br>";
    }

     echo "Panjang array saat ini: ";
     echo count($fruits);

    // Apakah Anda perlu melakukan perubahan pada skrip penggunaan struktur perulangan
    // FOR (skrip baris 5 – 8) untuk menampilkan seluruh data dalam array
    // $fruits dengan adanya penambahan 5 data baru? Mengapa demikian?
    // Jelaskan!
    //  Tidak perlu diubah, karena count($fruits) otomatis menyesuaikan jumlah elemen array 
    // setelah data ditambahkan.
    echo "<br><br>";

    //  3.2.2. Buat array baru dengan nama $veggies yang memiliki 3 buah data!
    $veggies = array("Tomat", "Wortel", "Sawi");
    for ($i = 0; $i < count($veggies); $i++) {
        echo $veggies[$i]. "<br>";
    } 

    // Apakah Anda membuat skrip baru untuk menampilkan
    // seluruh array $veggies ataukah Anda cukup sedikit memodifikasi skrip yang
    // sudah ada? Mengapa demikian? Jelaskan!
    // Tidak membuat skrip baru, hanya memodifikasi sedikit dari skrip sebelumnya 
    // (mengganti nama array menjadi $veggies), karena struktur for dengan count() 
    // bisa digunakan untuk semua array.
?>

