<?php
$students = array (
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
);

//3.5.1
// Tambahkan 5 data baru dalam array $students!

$newstudents = array (
    array("Tiyas", "220404", "0812348765"),
    array("Putri", "220405", "0887654321"),
    array("Dewi", "220406", "0813572468"),
    array("Fatir", "220407", "0824687531"),
    array("Danu", "220408", "0881726354"),
);

foreach ($newstudents as $dum_student) {
    $students[] = $dum_student;
}

for($row = 0; $row < 8; $row++){
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for($col = 0; $col < 3; $col++){
        echo "<li>" . $students[$row][$col]. "</li>";
    }
    echo "</ul>";
}

//3.5.2
// Tampilkan data dalam array $students dalam bentuk tabel!

echo "<table border='1' cellspacing = '0' cellpadding = '5'>";
echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>NIM</th>" ;
    echo "<th>Mobile</th>";
echo "</tr>";

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for ($col = 0; $col < count($students[$row]); $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>