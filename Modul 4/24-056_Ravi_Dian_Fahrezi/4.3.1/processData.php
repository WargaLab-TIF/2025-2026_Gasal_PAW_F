<?php
    require 'validate.inc';

    $errors = []; // array untuk menyimpan pesan error

    if (validateName($_POST, 'username', $errors)) {
        echo 'Data OK! <br>';
    } else {  
        echo 'Data invalid! <br>';
        // Tampilkan pesan error spesifik jika ada
        if (isset($errors['username'])) {
            echo "Error: " . $errors['username'] . "<br>";
        }
    }
?>
