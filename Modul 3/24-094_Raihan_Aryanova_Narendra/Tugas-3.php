<?php
$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
echo "Andy is" .$height["Andy"]."cm tall.";
echo "<br>";

// 3.3.1
$height["Ravi"] = "190";
$height["Elgi"] = "191";
$height["Rayyan"] = "192";
$height["Sakera"] = "193";
$height["Ibra"] = "194";
$keys = array_keys($height);    
$values = array_values($height); 
$last_index = count($height) - 1; 
for ($i = 0; $i < count($height); $i++) {
    if ($i == $last_index) {
        echo $keys[$i] . " is " . $values[$i] . " cm tall ";
        echo "(indeks ke - " . $last_index . ").";
    }
}
echo "<br>";


// 3.3.2
array_splice($height,1,1);
$keys = array_keys($height);     
$values = array_values($height); 
$last_index = count($height) - 1; 
for ($i = 0; $i < count($height); $i++) {
    if ($i == $last_index) {
        echo $keys[$i] . " is " . $values[$i] . " cm tall ";
        echo "(indeks ke - " . $last_index . ").";
    }
}
echo "<br>";

// 3.3.3
$weight = array("andi" => "60", "Budi" => "50", "Cici" => "70"); 
$keys = array_keys($weight);     
$values = array_values($weight); 
for ($x = 0; $x < count($weight); $x++) {
    if ($x == 1) { 
        echo $keys[$x] . " is " . $values[$x] . " kg.";
        echo "(data ke - " . $x + 1 . ")";
    }
}
?>