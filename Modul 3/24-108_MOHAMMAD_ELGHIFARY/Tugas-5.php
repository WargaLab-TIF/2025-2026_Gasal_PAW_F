<?php
$students=array
    (
        array("Alex","220401","0812345678"),
        array("Bianca","220402","0812345687"),
        array("Candice","220403","0812345665"),
    );
for($row=0;$row<3;$row++){
    echo "<p><b>Row Number $row</p></b>";
    echo "<ul>";
    for($col=0;$col<3;$col++) {
    echo"<li>".$students[$row][$col]."</li>";
    };
    echo"</ul>";
};
// 3.5.1.
echo '3.5.1';
echo "<br><br>";
$studentsBaru=array
    (
        array("Dani","220404","0812345679"),
        array("Erik","220405","0812345689"),
        array("Fany","220406","0812345669"),
        array("Gina","220407","0812345699"),
        array("Helcurt","220408","0812345999"),
    );
$students = array_merge($students, $studentsBaru);
var_dump($students);
// 3.5.2.
echo '3.5.2';
echo "<br><br>";
echo "<table border='1'>";
echo "<tr><th>Nama NIM</th><th>Mobile</th></tr>";

for ($i = 0; $i < count($students); $i++) {
    echo "<tr>";
    echo "<td>" . $students[$i][0]." ".$students[$i][1] . "</td>";
    echo "<td>" . $students[$i][2] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>