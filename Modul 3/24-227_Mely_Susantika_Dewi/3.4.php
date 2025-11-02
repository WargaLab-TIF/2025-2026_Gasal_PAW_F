<?php
// Array awal berisi 3 data
$height = [
    "Andy" => 176,
    "Barry" => 165,
    "Charlie" => 170
];

// Tambahkan 5 data baru
$height["Deni"] = 172;
$height["Eka"] = 168;
$height["Feri"] = 175;
$height["Gita"] = 158;
$height["Hana"] = 162;

// Menampilkan seluruh data menggunakan perulangan foreach
foreach ($height as $key => $value) {
    echo "Key = " . $key . ", Value = " . $value . "<br>";
}
?>

<?php
// Array baru berisi 3 data berat badan
$weight = [
    "Andy" => 65,
    "Barry" => 55,
    "Charlie" => 60
];

// Menampilkan seluruh data menggunakan foreach
foreach ($weight as $key => $value) {
    echo "Key = " . $key . ", Value = " . $value . "<br>";
}
?>
