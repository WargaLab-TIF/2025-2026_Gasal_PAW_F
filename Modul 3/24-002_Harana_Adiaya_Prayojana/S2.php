<?php
$arr=[
    "Andi"=>85,
    "Barry"=>76,
    "Caca"=>92,
    "Dina"=>80,
    "Erika"=>95
];
echo "Selamat yang Lulus dengan Nilai Terbaik:";
foreach($arr as $k=>$v){
    if($v>80){
        echo "<br>- Selamat, $k mendapat nilai $v";
    };
};
?>