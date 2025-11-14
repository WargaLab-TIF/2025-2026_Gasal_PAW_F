<?php
$students = array (
    array("Alex","220401", "0812345678"),
    array("Bianca","220402", "0812345687"),
    array("Candiee","220403", "0812345665"),
);
for ($row = 0; $row <3; $row++) {
    echo "<p><b>Row Number $row </b></p>";
    echo "<ul>";
    for ($col = 0; $col <3; $col++) {
        echo "<li>". $students[$row][$col]."</li>";
    }
    echo "</ul>";
};

/* == Jawaban 3.5.1 == */
echo "<br>";
echo "Data Baru: ";
echo "<br>";
// Tambahkan 5 data baru
$students[] = array("Dani", "220404", "0812345699");
$students[] = array("Ella", "220405", "0812345611");
$students[] = array("Felicya", "220406", "0812345622");
$students[] = array("Laila", "220407", "0812345633");
$students[] = array("Apni", "220408", "0812345644");

for ($row = 0; $row < 8; $row++) {   
    echo "<p><b>Row Number $row </b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>" . $students[$row][$col] . "</li>";
    }
    echo "</ul>";
}

/* == Jawaban 3.5.2 == */
// Tampilkan data dalam bentuk tabel 
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>No. HP</th>
      </tr>";

for ($row = 0; $row < 8; $row++) { // total sekarang ada 8 data
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>