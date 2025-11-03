<?php
// array_push()
$numbers = [1, 2, 3];
array_push($numbers, 4, 5);
echo "array_push(): ";
print_r($numbers);

// array_merge()
$a = ["A", "B"];
$b = ["C", "D"];
$merged = array_merge($a, $b);
echo "<br>array_merge(): ";
print_r($merged);

// array_values()
$assoc = ["x" => 10, "y" => 20];
$vals = array_values($assoc);
echo "<br>array_values(): ";
print_r($vals);

// array_search()
$pos = array_search("B", $merged);
echo "<br>array_search('B'): indeks ke-$pos";

// array_filter()
$even = array_filter($numbers, function($n) {
    return $n % 2 == 0;
});
echo "<br>array_filter() hasil bilangan genap: ";
print_r($even);

// Sorting
sort($numbers);
echo "<br>sort(): ";
print_r($numbers);
?>