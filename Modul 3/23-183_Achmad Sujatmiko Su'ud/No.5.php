<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

$students[] = array("David", "220404", "0812345699");
$students[] = array("Erika", "220405", "0812345600");
$students[] = array("Fiona", "220406", "0812345611");
$students[] = array("Gerry", "220407", "0812345622");
$students[] = array("Hana", "220408", "0812345633");

echo "Data berhasil ditambahkan. Total data sekarang: " . count($students) . "<br><br>";

echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr style='background-color:#ddd; font-weight:bold;'>
        <td>Name</td>
        <td>NIM</td>
        <td>Mobile</td>
      </tr>";

// Tampilkan semua data siswa dalam bentuk tabel
for($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for($col = 0; $col < count($students[$row]); $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>
