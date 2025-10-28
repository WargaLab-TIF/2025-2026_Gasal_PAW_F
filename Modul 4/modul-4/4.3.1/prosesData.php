<?php
require 'validate.inc';

$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (validateName($_POST, 'username', $error)){
        echo "data OK !";
    } 
    else {
        if (isset($error['username'])){
            echo $error['username'];
        }
        else{
            echo "data invalid !";
        }
    }
}
?>
