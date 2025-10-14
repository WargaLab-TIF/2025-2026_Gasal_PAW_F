<?php 
$fruits = array("Avocado", "Blueberry", "Cherry"); 
$arrlength = count($fruits); 
 
for ($x = 0; $x < $arrlength; $x++) { 
    echo $fruits[$x]; 
    echo "<br>"; 
} 
?> 

<?php 
$fruits = ["Avocado", "Blueberry", "Cherry"]; 
$new_fruits = ["Strawbery", "Leci", "Guava", "Grape", "Banana"]; 
 
for ($i = 0; $i < count($new_fruits); $i++) { 
    $fruits[] = $new_fruits[$i]; 
} 
 
echo "Jumlah data sekarang: " . count($fruits) . "<br>"; 
for ($i = 0; $i < count($fruits); $i++) { 
    echo "Buah ke-$i : " . $fruits[$i] . "<br>"; 
    echo "<br>"; 
} 
?> 

<?php
$veggies = ["Carrot", "Broccoli", "Tomato"];
for ($i=0; $i < count($veggies); $i++) {
    echo "sayur ke-$i : " . $veggies[$i] . "<br>";
}
?>

