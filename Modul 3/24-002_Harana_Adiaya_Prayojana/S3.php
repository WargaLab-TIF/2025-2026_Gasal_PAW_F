<?php
$arr=[
    ["Jakarta", [32, 33, 31, 30, 34, 33, 32]],
    ["Bandung", [22, 21, 20, 23, 22, 21, 22]], 
    ["Surabaya", [34, 35, 36, 34, 33, 35, 34]]
];
$le=count($arr)-1;
for ($r=0;$r<=$le;$r++){
    $kota=$arr[$r][0];
    $temp=$arr[$r][1];
    $lec=count($temp);
    $hasil=0;
    foreach($temp as $l){
        $hasil+=$l;
    }
    $rata=$hasil/$lec;
    echo"<br>Suhu Rata Rata Kota $kota adalah $rata";
}
?>