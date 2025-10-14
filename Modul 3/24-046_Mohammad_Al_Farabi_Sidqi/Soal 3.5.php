<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

for ($row = 0;$row < 3;$row++){
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for ($col = 0;$col <3;$col++){
        echo "<li>". $students[$row][$col] ."</li>";
    }
    echo "</ul>";
}

#3.5.1
array_push($students,
    array("Mas", "240046", "0812345699"),
    array("Jayro", "240405", "0812345644"),
    array("Yohan", "240406", "0812345655"),
    array("Dio", "230407", "0812345633"),
    array("Fulan", "230408", "0812345611")
);

#3.5.2
echo "<table border='1'>";
echo "<tr><th>Name NIM</th><th>Mobile</th></tr>";
foreach ($students as $s) {
    echo "<tr><td>$s[0] $s[1]</td><td>$s[2]</td></tr>";
}
echo "</table>";

