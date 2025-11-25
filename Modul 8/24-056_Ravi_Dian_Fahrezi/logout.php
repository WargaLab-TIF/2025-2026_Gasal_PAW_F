<?php
session_start();

unset($_SESSION['login']);
unset($_SESSION['username']);
unset($_SESSION['id_user']);
unset($_SESSION['level']);

header("Location: login.php");
?>