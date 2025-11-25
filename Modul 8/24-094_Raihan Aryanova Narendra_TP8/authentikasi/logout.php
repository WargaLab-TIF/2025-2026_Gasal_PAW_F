<?php 
session_start();
session_unset();
session_destroy();
header("location:login.php?pesan=logout");
exit();
?>