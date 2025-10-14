<?php
$height=array("andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
//menambah 5 data baru
$height["Rofik"] = 172;
$height["Nayla"] = 160;
$height["Alya"]  = 159;
$height["Kaka"]  = 178;
$height["Nur"]   = 157;
foreach($height as $x => $x_value){
    echo "key=" . $x . ", value=" . $x_value;
    echo "<br>";
}
?>

<?php
$weight = array("Andy" => "65", "Barry" => "70", "Charlie" => "68");

foreach ($weight as $key => $value) { 
echo "Key = " . $key . ", Value = " . $value . "<br>";
}
?>
