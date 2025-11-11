<?php
$array1=["Buku","Meja","Kursi","Spidol"];
sort($array1);
$array2=["Lampu","Proyektor","Papan Tulis"];
rsort($array2);
$array3=[];
echo "Daftar Inventaris Lengkap";
foreach($array1 as $i){
    $array3[]=$i;
}
foreach($array2 as $j){
    $array3[]=$j;
}
foreach($array3 as $k){
    echo "<br>$k";
}
?>