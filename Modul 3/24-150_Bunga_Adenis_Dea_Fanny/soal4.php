<?php
// 3.4.1
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// Tambahkan 5 data baru
$height += [
    "Dewi"   => "160",
    "Eka"    => "158",
    "Fajar"  => "172",
    "Gina"   => "168",
    "Hadi"   => "174"
];

$kunciHeight = array_keys($height);

echo "3.4.1 — Data height (setelah ditambah 5):<br>";
for ($i = 0; $i < count($kunciHeight); $i++) {
    $k = $kunciHeight[$i];
    echo "Key = $k, value = " . $height[$k] . " cm<br>";
}



// 3.4.2
$weight = array(
    "Andy"    => 65,
    "Barry"   => 58,
    "Charlie" => 62
);

$kunciWeight = array_keys($weight);

echo "<br>3.4.2 — Data weight (3 data):";
for ($i = 0; $i < count($kunciWeight); $i++) {
    $k = $kunciWeight[$i];
    echo "Key = $k, value = " . $weight[$k] . " kg<br>";
}
?>
