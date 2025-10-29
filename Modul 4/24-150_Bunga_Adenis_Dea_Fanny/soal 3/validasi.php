<?php
echo "<h3>Eksplorasi Validasi Server-side</h3>";

// 1) Regular Expression (preg_match)
$name = "Bambang Santoso";
if (preg_match("/^[a-zA-Z ]+$/", $name)) {
    echo "1) Nama valid: $name<br>";
} else {
    echo "1) Nama tidak valid: $name<br>";
}


// 2) String Functions (trim, strtolower, strtoupper)
$input = "   Hello Bambang   ";
$trimmed = trim($input);
$lower = strtolower($trimmed);
$upper = strtoupper($trimmed);

echo "<br>2) String asli: '$input'<br>";
echo "   Setelah trim(): '$trimmed'<br>";
echo "   Huruf kecil: $lower<br>";
echo "   Huruf besar: $upper<br>";

// 3) Filter Functions (filter_var)
$email = "bambang@gmail.com";
$url   = "https://contoh.local";
$ip    = "10.0.0.5";
$float = "123.45";

echo "<br>3) Email valid? ";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "YA ($email)<br>";
} else {
    echo "TIDAK ($email)<br>";
}

echo "   URL valid? ";
if (filter_var($url, FILTER_VALIDATE_URL)) {
    echo "YA ($url)<br>";
} else {
    echo "TIDAK ($url)<br>";
}

echo "   IP valid? ";
if (filter_var($ip, FILTER_VALIDATE_IP)) {
    echo "YA ($ip)<br>";
} else {
    echo "TIDAK ($ip)<br>";
}

echo "   Float valid? ";
if (filter_var($float, FILTER_VALIDATE_FLOAT)) {
    echo "YA ($float)<br>";
} else {
    echo "TIDAK ($float)<br>";
}


// 4) Type Testing (is_int, is_float, is_numeric, is_string)
$age   = "30";   // string numeric
$price = 55.5;   // float

echo "<br>4) Pemeriksaan tipe data:<br>";
echo "age:'$age'<br>";
echo "price:$price<br>";

// Cek apakah $age bertipe integer
echo "is_int age: ";
if (is_int($age)) {
    echo "true<br>";
} else {
    echo "false (karena '30' adalah string, bukan integer)<br>";
}

// Cek apakah $age berupa angka (meskipun string)
echo "is_numeric age: ";
if (is_numeric($age)) {
    echo "true (bernilai angka meski dalam bentuk string)<br>";
} else {
    echo "false<br>";
}

// Cek apakah $price adalah bilangan desimal
echo "is_float price: ";
if (is_float($price)) {
    echo "true<br>";
} else {
    echo "false<br>";
}

// Cek apakah $age adalah string
echo "is_string age: ";
if (is_string($age)) {
    echo "true (karena nilai '30' disimpan dalam bentuk teks)<br>";
} else {
    echo "false<br>";
}


// 5) Date Validation (checkdate)
$bulan = 2; 
$hari  = 29; 
$tahun = 2023; 

if (checkdate($bulan, $hari, $tahun)) {
    echo "<br>5) Tanggal valid: $hari-$bulan-$tahun<br>";
} else {
    echo "<br>5) Tanggal tidak valid: $hari-$bulan-$tahun<br>";
}

?>
