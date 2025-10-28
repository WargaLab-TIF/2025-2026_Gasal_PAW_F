<?php
require 'validate.inc';
$err = [];
$showSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    validateName($_POST, 'username', $err);
    validateEmail($_POST, 'email', $err);
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