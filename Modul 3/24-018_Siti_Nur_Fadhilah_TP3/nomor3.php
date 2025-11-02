<?php
// Mulai: deklarasi array asosiatif awal
$height = array(
    "Andy"    => "176",
    "Barry"   => "165",
    "Charlie" => "170"
);


echo "Array awal \$height:\n";
print_r($height);
echo "\n";

// 3.3.1 Tambahkan 5 data baru dalam array $height
$newData = array(
    "David"   => "172",
    "Emily"   => "168",
    "Fiona"   => "165",
    "George"  => "180",
    "Helen"   => "169"
);

// tambahkan menggunakan loop foreach
foreach ($newData as $k => $v) {
    $height[$k] = $v;
}

echo "<br><br>" ;
echo "Nomor 3.3.1 :<br>";
echo "Setelah menambahkan 5 data baru:\n";
print_r($height);
echo "\n";

// Tampilkan nilai dengan indeks (key) terakhir dari array $height
$lastKey = array_key_last($height);
echo "Indeks (key) terakhir: " . $lastKey . "\n";
echo "Nilai pada indeks terakhir: " . $height[$lastKey] . " cm\n\n";
echo "<br>";

// 3.3.2 Hapus 1 data tertentu dari array $height 
echo "<br><br>" ;
echo "Nomor 3.3.2 :<br>";
unset($height["Barry"]);
echo "Setelah menghapus data 'Barry':\n";
print_r($height);
echo "\n";

// Tampilkan nilai dengan indeks terakhir setelah penghapusan
$lastKeyAfterUnset = array_key_last($height);
echo "Indeks (key) terakhir setelah penghapusan: " . $lastKeyAfterUnset . "\n";
echo "Nilai pada indeks terakhir setelah penghapusan: " . $height[$lastKeyAfterUnset] . " cm\n\n";
echo "<br>";

// 3.3.3 Buat array baru $weight yang memiliki 3 buah data
$weight = array(
    "Andy"    => "70",
    "Barry"   => "65",
    "Charlie" => "68"
);

echo "<br><br>" ;
echo "Nomor 3.3.3 :<br>";
echo "Array \$weight:\n";
print_r($weight);
echo "\n";

// Tampilkan data ke-2 dari array $weight
// Karena array asosiatif, untuk mengambil 'data ke-2' berdasarkan urutan, kita gunakan array_values()
$weight_values = array_values($weight);
// pastikan index 1 ada
if (isset($weight_values[1])) {
    echo "Data ke-2 dari array \$weight (berdasarkan urutan values): " . $weight_values[1] . "\n";
} else {
    echo "Tidak ada data ke-2 pada array \$weight.\n";
}
echo "<br>";

?>
