<?php
//array_push()
$fruits = ["Apple", "Banana"];
array_push($fruits, "Cherry", "Mango");
echo "array_push(): "; 
print_r($fruits);
//array_merge()
$a = ["Apple", "Banana"];
$b = ["Mango", "Orange"];
$merged = array_merge($a, $b);
echo "<br>array_merge(): "; 
print_r($merged);
//array_values()
$fruits = ["a" => "Apple", "b" => "Banana", "c" => "Cherry"];
echo "<br>array_values(): "; 
print_r(array_values($fruits));
//array_search()
$fruits = ["Apple", "Banana", "Cherry"];
echo "<br>array_search(): "; 
echo "Index Banana: " . array_search("Banana", $fruits);
//array_filter()
$fruits = ["Apple", "Kiwi", "Banana", "Pear", "Cherry"];
$filtered = array_filter($fruits, fn($f) => strlen($f) > 5);
echo "<br>array_filter(): "; 
print_r($filtered);
//sorting
sort($fruits);
echo "<br>sort(): "; 
print_r($fruits); 
?> 