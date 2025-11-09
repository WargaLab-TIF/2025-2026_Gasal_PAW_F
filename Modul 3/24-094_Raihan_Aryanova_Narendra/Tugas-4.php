<?php
// 3.4.1
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
$height["Ravi"] = "190";
$height["Elgi"] = "191";
$height["Rayyan"] = "192";
$height["Sakera"] = "193";
$height["Ibra"] = "194";
foreach ($height as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}

// 3.4.2
$weight = array("andi" => "60", "Budi" => "50", "Cici" => "70"); 
foreach ($weight as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
?>
