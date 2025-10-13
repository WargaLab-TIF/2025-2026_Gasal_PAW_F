<?php

$student = array
	(
	array("Alex","220401","0812345678"),
	array("Bianca","220402","0812345687"),
	array("Candice","22043","0812345666")
	);


for ($row = 0; $row<3; $row++){
	echo "<p><b> Row number $row </b></p>";
	echo"<ul>";
	for($col = 0 ; $col <3; $col++){
		echo "<li>" . $student[$row][$col] . "</li>";
	}
	echo "</ul>";
}

#3.5.1
for ($i = 0; $i<5; $i++){ 
	$student[] = array("data-$i","22040$i","081234996$i");
}

echo "<table border=1>";
for ($row = 0; $row<8; $row++){
	echo "<tr>";
	for($col = 0 ; $col <3; $col++){
		echo "<td>" . $student[$row][$col] . "</td>";
	}
	echo "</tr>";
}
echo "</table>";
