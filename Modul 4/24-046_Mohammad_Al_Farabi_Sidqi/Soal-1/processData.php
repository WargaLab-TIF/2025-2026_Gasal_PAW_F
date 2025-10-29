<?php
require 'validate.inc';

$error = [];
if (validateName($_POST, 'surname', $error)){
    echo 'Data OK!';
} else {
    echo "Data invalid! <br>";
    foreach($error as $msg){
        echo $msg;
    }
}
?>
