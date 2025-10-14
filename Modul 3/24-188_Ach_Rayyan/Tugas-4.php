<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

foreach($height as $x => $x_value) {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
}
echo "<br>";

$height["rendi"] = "160";
$height["Lisa"] = "175";
$height["Rayyan"] = "168";
$height["anin"] = "180";
$height["Hannah"] = "172";

foreach($height as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
  }

echo "<br>";

$weight = array(
    "Rendi" => "250",
    "Safri" => "65",
    "Jihad" => "56"
);

foreach($weight as $x => $x_value) {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
}

  




?>
