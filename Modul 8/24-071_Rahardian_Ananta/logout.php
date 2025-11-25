<?php
    session_start();
    unset($_SESSION["login"]);
    unset($_SESSION["username"]);
    return header("Location: login.php");