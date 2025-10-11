<?php
$fruits= array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);
for($x =0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
};
// 3.2.1.
echo '3.2.1';
echo "<br>";
for($x =0; $x < 3; $x++) {
    array_push($fruits,"fruit$x");
};
for($x =0; $x < count($fruits); $x++) {
    echo $fruits[$x];
    echo "<br>";
};
// 3.2.2.
echo '3.2.2';
echo "<br>";
$veggies= ["Carrot","Broccoli","cabbage"];
for($x =0; $x < $arrlength; $x++) {
    echo $veggies[$x];
    echo "<br>";
};

?>