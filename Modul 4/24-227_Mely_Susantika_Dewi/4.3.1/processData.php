<?php
require 'validate.inc'; // memanggil fungsi validasi

if (validateName($_POST, 'surname'))
    echo 'Data OK!';
else
    echo 'Data invalid!';
?>

