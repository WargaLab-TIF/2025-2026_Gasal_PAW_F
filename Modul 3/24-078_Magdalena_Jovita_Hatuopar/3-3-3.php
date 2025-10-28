<?php
$weight = array("Andy" => 55, "Barry" => 60, "Charlie" => 65);

$key = array_keys($weight);      
$key_ke2 = $key[1];              

echo "Data ke-2 adalah " . $key_ke2 . " dengan berat badan " . $weight[$key_ke2] . " kg";
?>
