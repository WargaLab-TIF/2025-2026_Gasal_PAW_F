<?php
require 'validate.inc';
$err = [];
$showSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    validateName($_POST, 'username', $err);
    validateLength($_POST,'username',$err,3,20);
    validateEmail($_POST, 'email', $err);
    validateEmailFilter($_POST,'email',$err);
    validateNumeric($_POST,'usia',$err);
    validateInteger($_POST,'tahun',$err);
    validateURL($_POST,'url',$err);
    validateIP($_POST,'ip_address',$err);
    validateDate($_POST,'tanggal_lahir',$err,'Y-m-d');

    if (!$err) {
        $showSuccess = true;
    }
  }
include 'form.inc';
if ($showSuccess){
    echo '<br>Form submitted successfully with no errors';
}elseif($err){
    echo 'Terjadi kesalahan:';
    foreach($err as $e){ echo "<br> - $e";
  }
}
?>