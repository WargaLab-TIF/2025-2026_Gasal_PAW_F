<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170",);

foreach ($height as $x => $x_value) {
    echo "Key = ". $x . " Value = ". $x_value;
    echo "<br>";
}

/* == Jawaban 3.4.1 == */
echo "<br>";
echo "Data Baru: ";
echo "<br>";
// tambah data baru
$height["Lea"] = "180";
$height["Hexa"] = "172";
$height["Nory"] = "168";
$height["Bayy"] = "174";
$height["Henry"] = "177";

// tampilkan semua data dengan foreach
foreach ($height as $x => $x_value) {
    echo "Key = " . $x . " Value = " . $x_value;
    echo "<br>";
}

/* == Jawaban 3.4.2 == */
echo "<br>";
echo "Array Baru: ";
echo "<br>";
// buat array baru
$weight = array( "Nia" => "60", "Larry" => "55", "Mey" => "58");

// tampilkan seluruh data array weight dengan perulangan foreach
foreach ($weight as $x => $x_value) {
    echo "Key = " . $x . " Value = " . $x_value . " kg";
    echo "<br>";
}
?>