<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modul 3</title>
</head>
<body>
    <?php
    echo '<h3>3.1 Deklarasi dan akses array terindeks </h3>';
    $fruits = array('Avocado', 'Blueberry', 'Cherry');
    echo 'I like ' . $fruits[0] . ', ' . $fruits[1] . ', ' . $fruits[2] . '.';
    echo '<br>';

    echo '<h4>3.1.1 Tambah data & Akses Indeks Tertinggi</h4>';

    // Tambah 5 data baru 
    array_push($fruits, 'Banana', 'Watermelon', 'Apple', 'Dragon Fruit', 'Papaya');

    echo 'Array Fruits:';
    var_dump($fruits);
    echo "<br>";

    // Hitung indeks tertinggi
    $indeks_tertinggi = count($fruits) - 1;

    echo 'Indeks tertinggi: ' . $indeks_tertinggi . '<br>';
    echo 'Buah terakhir: ' . $fruits[$indeks_tertinggi];

    echo '<br><br>';
    echo '<h4>3.1.2 Hapus data & Akses Indeks Tertinggi</h4>';

    unset($fruits[3]);

    // Susun ulang 
    $fruits = array_values($fruits);
    var_dump($fruits);

    $indeks_tertinggi = count($fruits) - 1;
    echo "<br>";
    echo 'Indeks tertinggi: ' . $indeks_tertinggi . '<br>';
    echo 'Buah terakhir: ' . $fruits[$indeks_tertinggi];

    echo '<h4>3.1.3 Membuat Array $veggie</h4>';

    $veggies = ['Wortel', 'Sawi', 'Kangkung'];

    var_dump($veggies);
    ?>
</body>
</html>
