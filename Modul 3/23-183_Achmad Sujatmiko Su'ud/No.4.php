<?php
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);
// Perulangan untuk menampilkan array asosiatif
foreach($height as $key => $value) {
    echo "Key = $key, Value = $value<br>";
}
// Tambahkan data baru
$height["Dewi"] = "158";
$height["Eka"] = "172";
$height["Farah"] = "168";
$height["Gilang"] = "180";
$height["Hadi"] = "177";

echo "Daftar tinggi badan setelah penambahan data:<br>";
foreach($height as $key => $value) {
    echo "Key = $key, Value = $value<br>";
}

$weight = array(
    "Andy" => 60,
    "Barry" => 70,
    "Charlie" => 55
);

echo "Daftar berat badan:<br>";
foreach($weight as $key => $value) {
    echo "Key = $key, Value = $value kg<br>";
}
?>
