<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170"
);

$height["David"] = "180";
$height["Farih"] = "172";
$height["Rian"] = "168";
$height["Aini"] = "174";
$height["Leomord"] = "169";

$indeks_terakhir = array_key_last($height);
$nilai_indeks_terakhir = $height[$indeks_terakhir];

echo "Indeks terakhir adalah $indeks_terakhir dengan nilai $nilai_indeks_terakhir";
?>