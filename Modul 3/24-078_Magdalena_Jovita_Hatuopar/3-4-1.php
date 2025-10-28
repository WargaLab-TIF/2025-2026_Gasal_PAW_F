<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170" );

$height["David"] = "180";
$height["Farih"] = "172";
$height["Rian"] = "168";
$height["Aini"] = "174";
$height["Leomord"] = "169";

foreach ($height as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
?>
