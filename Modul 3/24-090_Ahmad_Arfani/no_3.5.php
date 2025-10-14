<?php
$students = array(
    array("Alex","220401","0812345678"),
    array("Bianca","220402","0812345687"),
    array("Candice","220403","0812345665")
);
for($row=0;$row < 3; $row++){
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for ($col=0;$col<3;$col++){
        echo "<li>" . $students[$row][$col] . "</li>";
    }
    echo "</ul>";
}

echo "3.5.1" . "<br>";
$students[] = array("Klee", "220404", "0812345465");
$students[] = array("Diona", "220405", "0812345365");
$students[] = array("Qiqi", "220406", "0812345265");
$students[] = array("Furina", "220407", "0812345165");
$students[] = array("Keqing", "220408", "0812345065");
for($row=0;$row < 8; $row++){
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for ($col=0;$col<3;$col++){
        echo "<li>" . $students[$row][$col] . "</li>";
    }
    echo "</ul>";
}

echo "3.5.2" . "<br>";
echo "<table border='1'>";
echo   "<tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>No. Telp</th>
    </tr>";
for ($row=0; $row < 8; $row++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>