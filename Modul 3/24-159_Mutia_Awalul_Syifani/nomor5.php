<?php
// Implementasi Awal
echo "<h4>Implementasi awal</h4>";

$students = array
(
    array("Alex","220401","0812345678"),
    array("Bianca","220402","0812345687"),
    array("Candice","220403","0812345665"),
);
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>Mobile</th>
      </tr>";
for ($row = 0; $row < count($students); $row++){
    echo "<tr>";
    for ($col = 0; $col < 3; $col++){
        echo "<td>".$students[$row][$col]."</td>";
    }
    echo "</tr>";
}
echo "</table>";
// Tambah 5 data baru
echo "<h4>Implementasi menambah 5 data baru</h4>";

array_push(
    $students,
    array("Michelle", "240402","0874567234"),
    array("John", "240432","087456879"),
    array("Noah", "240452","0874567564"),
    array("Kimberly", "240492","0874567237"),
    array("Ashraf", "240422","0874567123")
);
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>Mobile</th>
      </tr>";
for ($row = 0; $row < count($students); $row++){
    echo "<tr>";
    for ($col = 0; $col < 3; $col++){
        echo "<td>".$students[$row][$col]."</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<?php
// $students = array(
//     array("Alex", "220401", "0812345678"),
//     array("Bianca", "220402", "0812345687"),
//     array("Candice", "220403", "0812345665"),
// );

// echo "<table border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse;'>";
// echo "<tr><th>Name NIM</th><th>Mobile</th></tr>";

// for ($row = 0; $row < count($students); $row++) {
//     echo "<tr>";
//     echo "<td>" . $students[$row][0] . " " . $students[$row][1] . "</td>";
//     echo "<td>" . $students[$row][2] . "</td>";
//     echo "</tr>";
// }

// echo "</table>";
?>
