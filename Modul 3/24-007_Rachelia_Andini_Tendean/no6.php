<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modul 3 - Array Multidimensi</title>
</head>
<body>
<?php
    echo '<h3>3.6 Eksplorasi lanjut terhadap array </h3>';

    echo '<h4>3.6.1 Implementasi fungsi array_push()! </h4>';
    //array push
    $fruits = array("Mangga", "Pepaya");
    array_push($fruits, "Rambutan");
    var_dump($fruits);

    echo '<h4>3.6.2 Implementasi fungsi array_merge()! </h4>';
    $fruits = array("Mangga", "Pepaya");
    $fruits2 = array("Melon");
    $fruits3 = array_merge($fruits, $fruits2);
    var_dump($fruits3);

    echo '<h4>3.6.3 Implementasi fungsi array_values()! </h4>';
    //values
    $data = array(
        "nama" => "Rachelia Andini Tendean",
        "NIM" => "240411100007",
    );

    $idx = array_values($data);
    
    var_dump($data);
    echo '<br><br>';
    var_dump($idx);

    echo '<h4>3.6.4 Implementasi fungsi array_search()! </h4>';
    //search
    $fruits = array("Mangga", "Pepaya");

    $hasil= array_search("Melon", $fruits);
    var_dump($hasil);

    echo '<h4>3.6.5 Implementasi fungsi array_filter()! </h4>';
    //filter
    $nilai = array(
        "Rachelia" => 80,
        "Windy" => 75,
        "Yaya" => 74,
    );

    $nilai_kkm = array_filter($nilai, function ($nilai){
        if($nilai >= 75){
            return True;
        } else {
            return False;
        }
    });

    var_dump($nilai);
    echo '<br><br>';
    var_dump($nilai_kkm);

    echo '<h4>3.6.6 Implementasi berbagai fungsi sorting pada array! </h4>';
    // sort
    $nilai = [76, 97, 72, 64, 21];
    sort($nilai);
    var_dump($nilai);
    echo '<br><br>';

    // rsort
    $nilai = [76, 97, 72, 64, 21];
    rsort($nilai);
    var_dump($nilai);
    echo '<br><br>';

    // asort
    $nilai_sma = array(
        "Rachelia" => 80,
        "Windy" => 75,
        "Yaya" => 74,
    );
    asort($nilai_sma);
    var_dump($nilai_sma);
    echo '<br><br>';

    //ksort
    $nilai_sma = array(
        "Rachelia" => 80,
        "Windy" => 75,
        "Yaya" => 74,
    );
    ksort($nilai_sma);
    var_dump($nilai_sma);
    echo '<br><br>';
?>
</body>
</html>
