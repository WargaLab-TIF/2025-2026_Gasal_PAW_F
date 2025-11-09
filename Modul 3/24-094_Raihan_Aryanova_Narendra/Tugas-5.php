<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);
// 3.5.1
$students[] = array("Ravi", "220404", "081111111111");
$students[] = array("Elgi", "220405", "082222222222");
$students[] = array("Rayyan", "220406", "083333333333");
$students[] = array("Sakera", "220407", "084444444444");
$students[] = array("Ibra", "220408", "085555555555");


// #3.5.2
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name NIM</th><th>Mobile</th></tr>";

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for ($col = 0; $col < count($students); $col++) {
        if ($col == 0) {
            echo "<td>" . $students[$row][0] . " " . $students[$row][1] . "</td>";
            echo "<td>" . $students[$row][2] . "</td>";
    }
}
    echo "</tr>";
}

echo "</table>";
?>
