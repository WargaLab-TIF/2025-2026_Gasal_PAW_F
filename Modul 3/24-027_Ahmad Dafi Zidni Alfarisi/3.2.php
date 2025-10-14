<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$newData = ["Dragonfruit", "Elderberry", "Fig", "Grape", "Honeydew"];


for ($i = 0; $i < count($newData); $i++) {
    $fruits[] = $newData[$i];
}

$arrlength = count($fruits);
for($x = 0; $x < $arrlength; $x++) {
  echo $fruits[$x];
  echo "<br>";
}

echo "Panjang array saat ini: " . $arrlength;

echo "<br><br>";
?>

<?php
$veggies = array("Carrot", "Broccoli", "Spinach");

$veggiesLength = count($veggies);
for($x = 0; $x < $veggiesLength; $x++) {
  echo $veggies[$x];
  echo "<br>";
}
?>

