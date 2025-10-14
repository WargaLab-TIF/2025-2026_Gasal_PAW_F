<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Henry"] = "182";

foreach($height as $x => $x_value) {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
}
echo "<br><br>";
?>

<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"68");

foreach($weight as $key => $value) {
  echo "Key=" . $key . ", Value=" . $value;
  echo "<br>";
}
?>