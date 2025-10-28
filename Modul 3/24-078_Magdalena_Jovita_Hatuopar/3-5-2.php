<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
    array("Fahri", "220404", "0812345611"),
    array("Gina", "220405", "0812345622"),
    array("Hafiz", "220406", "0812345633"),
    array("Hamid", "220407", "0812345644"),
    array("Zahir", "220408", "0812345655")
);

echo "<h3>Data Mahasiswa</h3>";
echo "<table border='1' cellspacing='0' cellpadding='8'>";
echo "<tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>No. HP</th>
      </tr>";

$total_student = count($students);

for ($row = 0; $row < $total_student; $row++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
