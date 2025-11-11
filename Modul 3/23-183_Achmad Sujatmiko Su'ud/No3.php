<?php

$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

echo "Andy is " . $height["Andy"] . " cm tall.<br><br>";

$height["Dewi"] = "158";
$height["Eka"] = "172";
$height["Farah"] = "168";
$height["Gilang"] = "180";
$height["Hadi"] = "177";

echo "Daftar tinggi badan:<br>";
foreach($height as $name => $val){
    echo "$name = $val cm<br>";
}

// Menampilkan nilai dengan indeks terakhir
$lastValue = end($height);
$lastKey = key($height);

echo "<br>Nilai dengan indeks terakhir: $lastKey = $lastValue cm<br><br>";

unset($height["Charlie"]); // hapus salah satu data
echo "Daftar tinggi badan setelah penghapusan:<br>";
foreach($height as $name => $val){
    echo "$name = $val cm<br>";
}
// Menampilkan data terakhir setelah dihapus
$lastValue = end($height);
$lastKey = key($height);
echo "<br>Nilai dengan indeks terakhir: $lastKey = $lastValue cm<br><br>";

$weight = array(
    "Andy" => 60,
    "Barry" => 70,
    "Charlie" => 55
);

// Menampilkan seluruh data
echo "Daftar berat badan:<br>";
foreach($weight as $name => $val){
    echo "$name = $val kg<br>";
}

// Ambil data ke-2 berdasarkan urutan
$keys = array_keys($weight);
$secondKey = $keys[1];
echo "<br>Data ke-2 dari array \$weight: $secondKey = " . $weight[$secondKey] . " kg<br><br>";
?>
