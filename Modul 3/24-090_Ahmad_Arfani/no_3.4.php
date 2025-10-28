<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
foreach($height as $x => $x_value){
    echo "Keys-" . $x . ", Value-" . $x_value;
    echo "<br>";
}

echo "<br>" . "3.4.1" . "<br>";
$height["Klee"] = "127";
$height["Diona"] = "135";
$height["Qiqi"] = "140";
$height["Furina"] = "166";
$height["Keqing"] = "158";
foreach($height as $x => $x_value){
    echo "Keys-" . $x . ", Value-" . $x_value;
    echo "<br>";
}

echo "<br>" . "3.4.2" . "<br>";
$weight = array("Noelle"=>"50", "Raiden"=>"60", "Mona"=>"52");
foreach($weight as $x => $x_value){
    echo "Keys-" . $x . ", Value-" . $x_value;
    echo "<br>";
}
?>