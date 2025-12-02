<?php

// 3.5.1
$student  = array(  
    array("Alex","220401","0812345678"),
    array("Binaca", "220402", "0812345678"),
    array("Candidance", "220403", "0812345665"),
);

$student[] = array("Intan", "2304111", "085171743947");
$student[] = array("Aulia", "2304112", "085171743948");
$student[] = array("Majid", "2304113", "085171743949");
$student[] = array("cipa", "2304114", "085171743911");
$student[] = array("salsabila", "2304115", "08517174399");

// 3.5.2
echo "<table border='1'>";
echo "<th> Name </th>";
echo "<th> NIM </th>";
echo "<th> Mobile </th>";

for($row = 0 ; $row < count($student) ; $row++){
    echo "<tr>";
    for($col = 0; $col < 3 ; $col++){
        echo "<td>" . $student[$row][$col]. "</td>";
    }
    echo "</tr>";
}
echo "</table>";
