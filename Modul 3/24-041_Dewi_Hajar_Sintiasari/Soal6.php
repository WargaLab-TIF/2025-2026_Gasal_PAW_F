<?php
# 3.6.1 array_push()
$array = [1, 2, 3];
array_push($array, 4);
print_r($array);
echo "<br>";

# 3.6.2 array_merge()
$array1 = [1, 2, 3];
$array2 = [4, 5, 6];
$mergedArray = array_merge($array1, $array2);
print_r($mergedArray);
echo "<br>";

# 3.6.3 array_values()
$array = ['a' => 1, 'b' => 2, 'c' => 3];
$values = array_values($array);
print_r($values);
echo "<br>";

# 3.6.4 array_search()
$array = [1, 2, 3, 4, 5];
$key = array_search(3, $array);
echo $key; //
echo "<br>";

# 3.6.5 array_filter()
$array = [1, 2, 3, 4, 5];
$filtered = array_filter($array, function($value) {
    return $value > 2;
});
print_r($filtered);
echo "<br>";

# 3.6.6 Implementasi berbagai fungsi sorting pada array!
// 1. sort()
$array = [4, 2, 8, 6, 1];
sort($array);
print_r($array); 

echo "<br>";
// 2. rsort()
$array = [4, 2, 8, 6, 1];
rsort($array);
print_r($array); 

echo "<br>";
// 3. asort()
$array = ['a' => 3, 'b' => 1, 'c' => 2];
asort($array);
print_r($array); 

echo "<br>";
// 4. arsort()
$array = ['a' => 3, 'b' => 1, 'c' => 2];
arsort($array);
print_r($array); 

echo "<br>";
// 5. ksort()
$array = ['c' => 2, 'a' => 3, 'b' => 1];
ksort($array);
print_r($array); 

echo "<br>";
// 6. krsort()
$array = ['c' => 2, 'a' => 3, 'b' => 1];
krsort($array);
print_r($array); 
echo "<br>";

// 7. usort()
$array = [3, 1, 4, 2, 5];
usort($array, function($a, $b) {
    return $b - $a; // menurun
});
print_r($array); 
?>