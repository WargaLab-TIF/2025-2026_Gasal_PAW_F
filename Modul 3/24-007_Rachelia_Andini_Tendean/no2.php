<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modul 3</title>
</head>
<body>
    <?php
    echo '<h3>3.2 Panjang array dan akses array terindeks menggunakan looping </h3>';
    $fruits = ['Avocado', 'Blueberry', 'Cherry'];
    $arrlength = count($fruits);

    for ($x = 0; $x < $arrlength; $x++){
        echo $fruits[$x];
        echo "<br>";
    }

    echo '<h4>3.2.1 Tambah data menggunakan perulangan FOR </h4>';
     // Tambahkan 5 data baru (secara manual dalam perulangan)
    $baru = ['Banana', 'Apple', 'Watermelon', 'Mango', 'Papaya'];
    for ($i = 0; $i < count($baru); $i++) {
        $fruits[] = $baru[$i];
    }

    // Hitung panjang array
    $arrlength = count($fruits);
    echo "Jumlah data dalam array fruits saat ini: $arrlength <br>";

    for ($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x] . "<br>";
    }

    // Panjang array fruits saat ini adalah 8.
    // Tidak perlu mengubah struktur perulangan FOR karena menggunakan count($fruits) yang otomatis menyesuaikan jumlah elemen.

    echo '<h4>3.2.2 Array $veggies & Perulangan FOR </h4>';

    $veggies = ['Carrot', 'Spinach', 'Broccoli'];
    $arrlength = count($veggies);

    for ($i = 0; $i < $arrlength; $i++) {
        echo $veggies[$i] . '<br>';
    }

    // Untuk menampilkan array veggies cukup memodifikasi sedikit skrip sebelumnya
    // dengan mengganti nama variabel karena struktur FOR-nya sama.
    ?>
</body>
</html>
