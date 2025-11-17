<?php
$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
foreach($height as $x=>$x_value) {
    echo "Key=" . $x .", value=" . $x_value;
    echo "<br>";
}
// 3.4.1.
echo '3.4.1';
echo "<br><br>";
$nama = ["Rendi", "Lemonaru", "Senku", "Gara", "Nobita"];
$heightnya = [77, 99, 45, 72, 60];
for ($i = 0; $i < count($nama); $i++) {
    $height[$nama[$i]] = $heightnya[$i];
};
foreach($height as $x=>$x_value) {
    echo "Key=" . $x .", value=" . $x_value;
    echo "<br>";
};
// 3.4.2.
echo '3.4.2';
echo "<br><br>";
$weight=["Andri"=>"76","Bani"=>"55","Suta"=>"25"];
foreach($weight as $x=>$x_value) {
    echo "Key=" . $x .", value=" . $x_value;
    echo "<br>";
};
?>