<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modul 3</title>
</head>
<body>
    <?php
    echo '<h3>3.3 Panjang array dan akses array terindeks menggunakan looping </h3>';
    $height = array('Andy'=>"176",'Barry'=>'165',"Charlie"=>'170');
    echo "Andy is ". $height['Andy']. "cm tall.";
    echo "<br>";

    echo '<h4>3.3.1 Tambah data & akses nilai indeks terakhir</h4>';
    $new = [
        "Aini" => "160",
        "Erik" => "173",
        "Ryan" => "162",
        "Lena" => "165",
        "Nia"  => "164"
    ];

    // Gabungkan array lama dan baru
    $height = array_merge($height, $new);

    echo 'Array Height:<br>';
    var_dump($height);
    echo "<br><br>";

    // Ambil nilai terakhir
    $nilai_terakhir = end($height);

    echo 'Nilai Terakhir: ' . $nilai_terakhir;
    echo '<br><br>';
    echo '<h4>3.3.2 Hapus data & Akses Indeks Tertinggi</h4>';
    echo '<br>';

    unset($height['Barry']);
    var_dump($height);
    echo "<br>";

    // Ambil nilai terakhir setelah penghapusan
    $value_terakhir = array_key_last($height);
    echo 'Nilai terakhir sekarang: ' . $height[$value_terakhir];

    echo '<br><br>';
    echo '<h4>3.3.3 Buat array $weight </h4>';

    $weight = [
    "Andy" => "68",
    "Barry" => "59",
    "Charlie" => "63"
    ];

    echo "Array Weight";
    echo '<br>';
    var_dump($weight);
    ?>
</body>
</html>
