    <?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlenght = count($fruits);

#3.2.1
for ($i = 0; $i < 5; $i++) {
    $fruits[] = "pruit" . $i;
}
$arrlenght = count($fruits); 
echo "Jumlah data: " . $arrlenght ."<br>";
for ($x = 0; $x < $arrlenght; $x++) {
    echo $fruits[$x];
    echo "<br>";    
}

#3.2.2
$veggies = array("Carrot", "Sawi", "Broccoli");
$arrlenght = count($veggies);

for ($x = 0; $x < $arrlenght; $x++) {
    echo $veggies[$x];
    echo "<br>";    
}
