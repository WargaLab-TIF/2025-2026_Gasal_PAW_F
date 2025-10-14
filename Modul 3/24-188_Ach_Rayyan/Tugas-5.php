<?php
$students = array
(
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
    echo"</ul>";
}


array_push(
    $students,
    array("Rendi", "220404", "0812345664"),
    array("Elghi", "220405", "0812345662"),
    array("Rayyan", "220408", "0812345669"),
    array("JUN", "220407", "0812345661"),
    array("Reno", "220408", "0812345988"),
);


echo "<table border='1' cellspacing='0' cellpadding='6' style='border-collapse: collapse;'>";
echo "<tr>
        <th>Name NIM</th>
        <th>Mobile</th>
      </tr>";

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    echo "<td>" . $students[$row][0] . " " . $students[$row][1] . "</td>"; 
    echo "<td>" . $students[$row][2] . "</td>";
    echo "</tr>";
}

echo "</table>";
