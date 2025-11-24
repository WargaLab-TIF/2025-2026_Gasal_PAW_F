<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
session_unset();
session_destroy();

header("Location:/praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
exit;
?>