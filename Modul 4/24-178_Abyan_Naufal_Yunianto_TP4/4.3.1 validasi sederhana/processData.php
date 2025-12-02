<?php
    require 'validate.inc.php';
    $error = validateName($_POST,'surname');

    if (empty($error)){
        echo 'Data OK!';
    } else {
        foreach($error as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
    };
?>