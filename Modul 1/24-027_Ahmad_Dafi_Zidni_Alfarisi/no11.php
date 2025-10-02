<?php
$str = "Hello world!";
$pos = strpos($str, "world");
if ($pos === false) {
    echo "'world' tidak ditemukan.";
} else {
    echo $pos;
}
?>
