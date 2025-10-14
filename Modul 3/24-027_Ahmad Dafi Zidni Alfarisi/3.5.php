<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

$students[] = array("David", "220404", "0812345604");
$students[] = array("Ethan", "220405", "0812345605");
$students[] = array("Frank", "220406", "0812345606");
$students[] = array("George", "220407", "0812345607");
$students[] = array("Henry", "220408", "0812345608");

echo "Jumlah data students sekarang: " . count($students);
echo "<br><br>";

for ($i = 0; $i < count($students); $i++) {
    echo "Nama: " . $students[$i][0] . "<br>";
    echo "NIM: " . $students[$i][1] . "<br>";
    echo "No HP: " . $students[$i][2] . "<br><br>";
}
?>

<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
    array("Dafi", "220404", "0812345604"),
    array("Zani", "220405", "0812345605"),
    array("Janny", "220406", "0812345606"),
    array("Mas", "220407", "0812345607"),
    array("Mbak", "220408", "0812345608")
);

echo "<table border='1'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for ($col = 0; $col < count($students[$row]); $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>
