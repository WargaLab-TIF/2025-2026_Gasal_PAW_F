<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
echo "Andy is " . $height['Andy'] . " cm tall.";

// 3.3.1
echo "<br>";
// Tambahkan 5 data baru dalam array $height! Tampilkan nilai dengan indeks terakhir dari array $height!

$height ["Putri"] = "160";
$height ["Danu"] = "170";
$height ["Fatir"] = "169";
$height ["Dewi"] = "155";
$height ["Tiyas"] = "158";

// Tampilkan nilai dengan indeks terakhir dari array $height!
echo 'Tinggi Tiyas adalah '. $height["Tiyas"] . " cm. <br>";


// 3.3.2
// Hapus 1 data tertentu dari array $height!
array_pop($height);

// Tampilkan nilai dengan indeks terakhir dari array $height!
echo "<br> nilai dengan indeks terakhir setelah hapus 1 data: Tinggi Dewi adalah ". $height["Dewi"];


// 3.3.3
// Buat array baru dengan nama $weight yang memiliki 3 buah data! 
echo "<br> <br>";

$weight = array("Lintang" => "50", "Nursita" => "43", "Putra" => "55");
// Tampilkan data ke-2 dari array $weight!
echo "Berat Nursita adalah: ".$weight["Nursita"];
?>