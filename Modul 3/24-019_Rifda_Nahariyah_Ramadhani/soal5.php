<!-- kode awal -->
<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

for ($row = 0; $row < 3; $row++) {
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>" . $students[$row][$col] . "</li>";
    }
    echo "</ul>";
}
echo "<br>";
?>

<!-- 3.5.1 Tambahkan 5 data baru ke array $students  -->
<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
    array("Dewi", "220404", "0812345699"),
    array("Fahri", "220405", "0812345601"),
    array("Fiona", "220406", "0812345602"),
    array("Jamal", "220407", "0812345603"),
    array("Sri", "220408", "0812345604")
);

for ($row = 0; $row < count($students); $row++) {
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>" . $students[$row][$col] . "</li>";
    }
    echo "</ul>";
}
echo "<br>";
?>

<!-- 3.5.2 Tampilkan data dalam bentuk tabel HTML -->
<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
    array("Dewi", "220404", "0812345699"),
    array("Fahri", "220405", "0812345601"),
    array("Fiona", "220406", "0812345602"),
    array("Jamal", "220407", "0812345603"),
    array("Sri", "220408", "0812345604")
);

echo "<h3>Data Students</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>No</th><th>Name</th><th>NIM</th><th>No HP</th></tr>";

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    echo "<td>" . ($row + 1) . "</td>";
    echo "<td>" . $students[$row][0] . "</td>";
    echo "<td>" . $students[$row][1] . "</td>";
    echo "<td>" . $students[$row][2] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
 