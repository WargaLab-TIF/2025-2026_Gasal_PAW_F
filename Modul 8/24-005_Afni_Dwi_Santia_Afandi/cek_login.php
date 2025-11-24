<?php
session_start();
// pengecekan kalau blm login itu itu langsung diarahkan balik ke login
if (!isset($_SESSION['login'])) {
    header("Location: /modul8/login.php");
    exit;
}
?>
