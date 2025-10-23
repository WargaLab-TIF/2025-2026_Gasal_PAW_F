<!-- kode awal -->
<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

foreach($height as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
echo "<br>";
?>

<!-- 3.4.1 Tambahkan 5 data baru ke array $height -->
<?php
$height = array(
    "Andy"=>"176",
    "Barry"=>"165",
    "Charlie"=>"170",
    "David"=>"180",
    "Evan"=>"172",
    "Putri"=>"169",
    "Zidan"=>"175",
    "Sari"=>"168"
);

foreach($height as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
echo "<br>";
?>

<!-- 3.4.2 Buat array baru $weight dengan 3 data dan tampilkan dengan foreach -->
<?php
$weight = array("Andy"=>"65", "Barry"=>"70", "Charlie"=>"60");

foreach($weight as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
?>