<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170",);
echo "Andy is ". $height['Andy']. "cm tall.";

/* == Jawaban 3.3.1 == */
// tambah data baru
$height["David"] = "180";
$height["Evan"] = "172";
$height["Frank"] = "168";
$height["George"] = "174";
$height["Henry"] = "177";

// tampilkan nilai dengan indeks terakhir
$nilai_terakhir = end($height);

echo "<br>";
echo "Nilai dengan indeks terakhir adalah: " . $nilai_terakhir . " cm";

/* == Jawaban 3.3.2 == */
// hapus 1 data 
unset($height["Henry"]);

// tampilkan nilai dengan indeks terakhir
$nilai_terakhir = end($height);

echo "<br>";
echo "Nilai dengan indeks terakhir adalah: " . $nilai_terakhir . " cm";

/* == Jawaban 3.3.3 == */
echo "<br>";
// array baru
$weight = array("Bobby" => "60", "Xavie" => "55", "Rex" => "58"
);

// tampilkan data ke-2 
$values = array_values($weight); 
echo "Data ke-2 dari array weight adalah: " . $values[1] . " kg";
?>