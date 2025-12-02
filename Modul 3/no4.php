
<?php

// 3.4.1 yaa
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

$height["karin"] = "150";
$height["kila"] = "174";
$height["Laravel"] = "50";
$height["Lila"] = "30";
$height["lea"] = "20";

foreach($height as $x => $x_value){
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";  
}

// 3.4.2 yaa
$weight = array("zafna" => "30", "adela" => "15", "giana" => "20");

foreach($weight as $x => $x_value){
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";  
}
?>

