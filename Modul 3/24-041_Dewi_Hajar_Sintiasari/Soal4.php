<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

foreach($height as $x => $x_value){
    echo "Key-". $x . ", Value-" . $x_value;
    echo "<br>";
}

//3.4.1
echo "<br>";

$height ["Putri"] = "160";
$height ["Danu"] = "170";
$height ["Fatir"] = "169";
$height ["Dewi"] = "155";
$height ["Tiyas"] = "158";

foreach($height as $x => $x_value){
    echo "Key-". $x . ", Value-" . $x_value;
    echo "<br>";
}

//3.4.2
echo "<br>";

$weight = array("Lintang" => "50", "Nursita" => "43", "Putra" => "55");
foreach($weight as $y => $y_weight){
    echo "Key-". $y . ", Value-" . $y_weight;
    echo "<br>";
}
?>