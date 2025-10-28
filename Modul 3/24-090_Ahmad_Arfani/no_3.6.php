<?php
echo "3.6.1" . "<br>";
$transp = array("Mobil","Sepeda","Becak");
array_push($transp, "Pesawat", "Perahu", "Motor");
print_r($transp);
echo "<br>";

echo "<br>" . "3.6.2" . "<br>";
$transp1 = array("Mobil","Sepeda","Becak");
$transmer = array("Jalan", "Ojek");
print_r(array_merge($transp1,$transmer));
echo "<br>";

echo "<br>" . "3.6.3" . "<br>";
$transp2 = array("Nama"=>"Keqing","Umur"=>"18","Tinggi"=>"156");
print_r(array_values($transp2));
echo "<br>";

echo "<br>" . "3.6.4" . "<br>";
$transp3 = array("Nama"=>"Keqing","Umur"=>"18","Tinggi"=>"156");
print_r(array_search("156",$transp3));
echo "<br>";

echo "<br>" . "3.6.5" . "<br>";
$transp4 = array("Mobil","Sepeda","Becak","Pesawat","Perahu");
$hasil = array_filter($transp4, function($item) {
    return strlen($item) > 5;
});
print_r($hasil);
echo "<br>";

echo "<br>" . "3.6.6" . "<br>";
$transp5 = array("Mobil","Sepeda","Becak","Pesawat","Perahu");
echo "sort (ascending)" . "<br>";
$asc = $transp5;
sort($asc);
print_r($asc);
echo "<br>";
echo "<br>" . "rsort (descending)" . "<br>";
$desc = $transp5;
rsort($desc);
print_r($desc);
echo "<br>";

echo "<br>" . "ksort (berdasarkan key ascending)" . "<br>";
$transp6 = array("Nama"=>"Keqing","Umur"=>"18","Tinggi"=>"156");
$asco = $transp6;
ksort($asco);
print_r($asco);
echo "<br>";

echo "<br>" . "krsort (berdasarkan key ascending)" . "<br>";
krsort($asco);
print_r($asco);
?>