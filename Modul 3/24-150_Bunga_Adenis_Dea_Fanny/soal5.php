<?php
// Data awal (sesuai contoh)
$students = array(
    array("Alex",    "220401", "0812345678"),
    array("Bianca",  "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
);

// Tambahkan 5 data baru (3.5.1)
$tambahan = array(
    array("Dion",  "220404", "081222333444"),
    array("Eka",   "220405", "081333444555"),
    array("Fajar", "220406", "081444555666"),
    array("Gina",  "220407", "081555666777"),
    array("Hadi",  "220408", "081666777888"),
);
for ($i = 0; $i < count($tambahan); $i++) {
    $students[] = $tambahan[$i];
}

// 3.5.2: Tampilkan dalam bentuk tabel 
echo "<table border='1' cellspacing='0' cellpadding='6' style='border-collapse:collapse'>";
echo "<tr><th>Nama</th><th>NIM</th><th>No. HP</th></tr>";

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";

    for ($col = 0; $col < count($students[$row]); $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>
