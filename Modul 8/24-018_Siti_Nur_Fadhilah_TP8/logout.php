<?php
    session_start();
    
    // Hapus semua variabel sesi
    $_SESSION = array();
    
    // Hancurkan sesi
    session_destroy();
    
    // Alihkan kembali ke halaman login.php
    header("Location: login.php");
    exit;
?>