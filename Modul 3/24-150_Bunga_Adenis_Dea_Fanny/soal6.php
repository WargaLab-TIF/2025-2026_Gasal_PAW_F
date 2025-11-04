<?php
//  3.6 — Eksplorasi Lanjut Array

//  3.6.1 array_push() 
$fruits = ["Avocado", "Blueberry", "Cherry"];
echo "3.6.1 array_push()<br>";
echo "Hasil sebelum: "; print_r($fruits);
array_push($fruits, "Pineapple", "Banana");


// echo "3.6.1 array_push()<br>";
echo "<br>Hasil sesudah: "; print_r($fruits);
echo "<br><br>";

// 3.6.2 array_merge() 
$a1 = ["A", "B", "C"];
$a2 = ["D", "E"];
$gabung = array_merge($a1, $a2);

echo "3.6.2 array_merge()<br>";
echo "Indexed: "; print_r($gabung); echo "<br><br>";


//  3.6.3 array_values() 
$nums = [10, 20, 30, 40];
unset($nums[1]); 
echo "3.6.3 array_values()<br>";
echo "Sebelum array_values(): "; print_r($nums); echo "<br>";
$numsRapi = array_values($nums);
echo "Sesudah array_values(): "; print_r($numsRapi); echo "<br><br>";

//  3.6.4 array_search() 
$a = array("a"=>"red","b"=>"green","c"=>"blue");
echo "3.6.4 array_search()<br>";
echo "Key untuk nilai 'red' adalah: " . array_search("red", $a);
echo "<br><br>";


//  3.6.5 array_filter()
$angka = [1,2,3,4,5,6,7,8,9,10];
$genap = array_filter($angka, fn($n)=>$n%2===0);

echo "3.6.5 array_filter()<br>";
echo "Genap: "; print_r(array_values($genap)); echo "<br><br>";


// 3.6.6 Sorting: sort, rsort, asort, ksort 
$nilai = [70, 95, 60, 80];
$nilaiAsc  = $nilai; sort($nilaiAsc);
$nilaiDesc = $nilai; rsort($nilaiDesc);

$nilaiMhs = ["Andi"=>80, "Budi"=>75, "Cici"=>90];
$byNilai  = $nilaiMhs; asort($byNilai);
$byNama   = $nilaiMhs; ksort($byNama);

echo "3.6.6 Sorting<br>";
echo "sort()  ASC (indexed): ";  print_r($nilaiAsc);  echo "<br>";
echo "rsort() DESC (indexed): "; print_r($nilaiDesc); echo "<br>";
echo "asort() ASC by value (assoc): "; print_r($byNilai); echo "<br>";
echo "ksort() ASC by key   (assoc): "; print_r($byNama); echo "<br>";
?>
